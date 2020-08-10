<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\Products;
use App\Notifications\sendEstimate;
use App\Notifications\sendInvoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mollie\Laravel\Facades\Mollie;
use mysql_xdevapi\Exception;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all()->where('company_id', Auth::id());
        $clients = Client::all()->where('company_id', Auth::id());

        return view('invoices.index', compact('invoices', 'clients'));
    }

    public function postCreate(Request $request)
    {

        $request->validate([
            'client' => 'required',
            'due_date' => 'required',
            'discount' => 'required',
            'total_items' => 'required',
        ]);

        $validate_array = [];
        for ($i = 1; $i < $request->post('total_items') + 1; $i++) {

            $request->validate([
                'amount' . $i => 'required',
                'description' . $i => 'required',
                'vat' . $i => 'required',
                'price' . $i => 'required',
            ]);
        }


        $sign_id = Str::random(50);
        $total = (float)0.00;
        $productTotal = [0];

        for ($i = 1; $i < $request->post('total_items') + 1; $i++) {
            $noVatTotal = $request->post('price' . $i) * $request->post('amount' . $i);
            $vat = $noVatTotal / 100 * $request->post('vat' . $i);
            $vatTotal = $noVatTotal + $vat;
            $total = $total + $vatTotal;
            $productTotal[$i] = $total;
        }

        $amount = $total / 100 * $request->post('discount');
        $total = $total - $amount;

        $invoice = Invoice::create([
            'title' => $request->post('title'),
            'due_date' => $request->post('due_date'),
            'discount' => $request->post('discount'),
            'total' => $total,
            'amount' => $amount,
            'company_id' => Auth::id(),
            'client_id' => $request->post('client'),
        ]);

        for ($i = 1; $i < $request->post('total_items') + 1; $i++) {
            Products::create([
                'description' => $request->post('description' . $i),
                'amount' => $request->post('amount' . $i),
                'tax' => $request->post('vat' . $i),
                'price' => $request->post('price' . $i),
                'invoice_id' => $invoice->id,
                'discount' => $request->post('discount'),
                'total' => $productTotal[$i],
            ]);
        }
        $discription = $estimate->nummber;

        if ($estimate->title != null) {
            $discription->title;
        }


        return back();
    }


    public function show($id)
    {
        $invoice = Invoice::all()->find($id);
        if ($invoice->company_id = Auth::id()){
            $products = $invoice->products;
            $clients = Client::all()->where('company_id', Auth::id());

            return view('invoices.show', compact('invoice', 'products', 'clients'));
        }
        return back();
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::all()->find($id);
        $products = Products::all()->where('invoice_id', '=', $id);

        $request->validate([
            'client' => 'required',
            'due_date' => 'required',
            'discount' => 'required',
            'total_items' => 'required',
        ]);

        $validate_array = [];
        for ($i = 1; $i < $request->post('total_items'); $i++) {

            $request->validate([
                'amount' . $i => 'required',
                'description' . $i => 'required',
                'vat' . $i => 'required',
                'price' . $i => 'required',
            ]);
        }


        $sign_id = Str::random(50);
        $total= (float) 0.00;
        $productTotal =[0];

        for ($i = 1; $i < $request->post('total_items')+1; $i++) {
            $noVatTotal = $request->post('price' . $i) * $request->post('amount' . $i);
            $vat = $noVatTotal / 100 * $request->post('vat' . $i);
            $vatTotal = $noVatTotal + $vat;
            $total = $total + $vatTotal;
            $productTotal[$i] = $total;
        }

        $amount = $total / 100 * $request->post('discount');
        $total = $total - $amount;

        $invoice->update([
            'title' => $request->post('title'),
            'sign_id' => $sign_id,
            'due_date' => $request->post('due_date'),
            'discount' => $request->post('discount'),
            'total' => $total,
            'amount' => $amount,
            'company_id' => Auth::id(),
            'client_id' => $request->post('client'),
        ]);

        $i = 0;

        foreach ($products as $product) {
            $i++;
            $product->update([
                'description' => $request->post('description' . $i),
                'amount' => $request->post('amount' . $i),
                'tax' => $request->post('vat' . $i),
                'price' => $request->post('price' . $i),
                'estimate_id' => $invoice->id,
                'discount' => $request->post('discount'),
                'total' => $productTotal[$i],
            ]);
        }

        return back();
    }

    public function send(Request $request, $id)
    {


        $request->validate([
            'send_date' => 'required',
            'color' => 'required',
            'mollie_key' => 'required',
        ]);

        $send_date = $request->post('send_date');

        $user = Company::all()->find(Auth::id());

        $invoice = Invoice::all()->find($id);
        if ($request->has('save_key')) {
            $invoice->company->mollie_key = $request->post('mollie_key');
            $invoice->company->save();
        }
        if ($send_date == date('Y-m-d')) {
            $description = $invoice->number;
            if ($invoice->title != null) {
                $description = $invoice->title;
            }
            $invoice->number = '#FAC' . random_int(0, 9) . random_int(0, 9) . random_int(0, 9) . random_int(0, 9);
            $invoice->save();

            Mollie::api()->setApiKey($request->post('mollie_key'));
            $payment = Mollie::api()->payments()->create([
                'amount' => [
                    'currency' => 'EUR',
                    'value' => $invoice->total,
                ],
                'description' => 'Invoice  ' . $description,
                'webhookUrl' => 'https://webhook.site/ee4f2604-574a-479a-a678-cd8a4ee919f6',
                'redirectUrl' => 'http://localhost:8000/company/invoices',
                'method' => 'creditcard',
                'metadata' => array(
                    'order_id' => $invoice->number
                )
            ]);


            if ($payment) {
                $invoice->pay_id = $payment->_links->checkout->href;
                $invoice->save();
                $send_date = $request->post('send_date');
                $color = $request->post('color');


                $invoice->client->notify(new sendInvoice($invoice, $color));
                $invoice->update([
                    'send_date' => $send_date,
                ]);
                return back();

            } else {
                $invoice->number = null;
                $invoice->save();
                return back();
            }
        }
        $invoice->update([
            'send_date' => $send_date,
            'color' => $request->post('color')
        ]);
        return back();
    }

    public function destroy($id){
        $invoice = Invoice::all()->find($id);

        foreach ($invoice->products as $product){
            $product->delete();
            $product->description = 'deleted_'.time().'_'.$product->description;
            $product->save();
        }

        $invoice->delete();
        $invoice->number = 'deleted_'.time().'_'.$invoice->number;
        $invoice->sign_id = null;
        $invoice->save();
        return response()->json([
            'message' => 'Deleted estimate'
        ])->setStatusCode(200)->redirectTo('/estimates');


    }
}
