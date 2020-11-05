<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Estimate;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Products;
use App\Notifications\sendEstimate;
use Barryvdh\DomPDF\Facade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use setasign\Fpdi\PdfParser\StreamReader;
use Whoops\Util\TemplateHelper;

class AdminEstimateController extends Controller
{


    public function index()
    {
        $estimates = Estimate::all();
        $clients = Client::all();
        $companies = Company::all();

        return view('estimates.index', compact('estimates', 'clients', 'companies'));
    }

    public function search(Request $request)
    {
        $q = $request->post('q');
        $estimates = Estimate::search($q)->get();
        $clients = Client::all();

        return view('estimates.index', compact('estimates', 'clients'));
    }

    public function postCreate(Request $request)
    {
        $request->validate([
            'client' => 'required',
            'due_date' => 'required',
            'discount' => 'required',
            'total_items' => 'required',
            'company' => 'required'
        ]);

        $validate_array = [];
        for ($i = 1; $i < $request->post('total_items')+1; $i++) {

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

        $estimate = Estimate::create([
            'title' => $request->post('title'),
            'sign_id' => $sign_id,
            'due_date' => $request->post('due_date'),
            'discount' => $request->post('discount'),
            'total' => $total,
            'amount' => $amount,
            'company_id' => $request->post('company'),
            'client_id' => $request->post('client'),
        ]);

        for ($i = 1; $i < $request->post('total_items')+1; $i++) {
            Products::create([
                'description' => $request->post('description' . $i),
                'amount' => $request->post('amount' . $i),
                'tax' => $request->post('vat' . $i),
                'price' => $request->post('price' . $i),
                'estimate_id' => $estimate->id,
                'discount' => $request->post('discount'),
                'total' => $productTotal[$i],
            ]);
        }


        return back()->with([
            'success_message' => 'Created Estimate.'
        ]);
    }

    public function show($id)
    {
        $estimate = Estimate::find($id);

            $products = $estimate->products;
            $clients = Client::all();
            $companies = Company::all();

            return view('estimates.show', compact('estimate', 'products', 'clients','companies'));
    }

    public function update(Request $request, $id)
    {
        $estimate = Estimate::all()->find($id);
        $products = Products::all()->where('estimate_id', '=', $id);

        $request->validate([
            'client' => 'required',
            'due_date' => 'required',
            'discount' => 'required',
            'total_items' => 'required',
            'company' => 'required',
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

        $estimate->update([
            'title' => $request->post('title'),
            'sign_id' => $sign_id,
            'sign_date' => null,
            'due_date' => $request->post('due_date'),
            'discount' => $request->post('discount'),
            'total' => $total,
            'amount' => $amount,
            'company_id' => $request->post('company'),
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
                'estimate_id' => $estimate->id,
                'discount' => $request->post('discount'),
                'total' => $productTotal[$i],
            ]);
        }

        return back()->with([
            'success_message' => 'Updated estimate.'
        ]);
    }

    public function accept($id)
    {
        $estimate = Estimate::all()->find($id);
        if ($estimate->sign_date == null){
            $estimate->sign_date = Carbon::now();
            $estimate->number = '#of'.random_int(0, 9).random_int(0, 9).random_int(0, 9).random_int(0, 9);
            $estimate->sign_id = null;
            $estimate->save();

            $invoice = Invoice::create([
                'title' => $estimate->title,
                'due_date' => $estimate->due_date,
                'discount' => $estimate->discount,
                'total' => $estimate->total,
                'amount' => $estimate->amount,
                'company_id' => $estimate->Company->id,
                'client_id' => $estimate->client->id,
            ]);
            foreach ($estimate->products as $product){
                $product->invoice_id = $invoice->id;
                $product->save();
            }
            return back();
        }

        return back()->with([
            'error_message' => 'Could not accept Estimate.'
        ]);
    }

    public function send(Request $request, $id)
    {
        $request->validate([
            'send_date' => 'required',
            'color' => 'required',
        ]);

        $estimate = Estimate::all()->find($id);




        $send_date = $request->post('send_date');
        $color = $request->post('color');

        if ($send_date == date('Y-m-d')){
            $estimate->client->notify(new sendEstimate($estimate, $color));
            $estimate->update([
                'send_date' => $send_date,
                'color' => $color
            ]);
            return back()->with([
                'success_message' => 'Estimate sent.'
            ]);
        }

        $estimate->update([
            'send_date' => $send_date,
            'color' => $color
        ]);
        return back()->with([
            'success_message' => 'Estimate will be send on '.$send_date.'.'
        ]);
    }

    public function link(Request $request, $id){
        $estimate = Estimate::find($id);

        $estimate->client_id = $request->post('client');
        $estimate->save();

        return back()->with([
            'success_message' => 'Linked client to Estimate.'
        ]);
    }

    public function unlink($id){
        $estimate = Estimate::find($id);

        $estimate->client_id = null;
        $estimate->save();

        return back()->with([
            'success_message' => 'Unlinked client to Estimate.'
        ]);
    }

    public function linkCompany(Request $request, $id){
        $estimate = Estimate::find($id);

        $estimate->company_id = $request->post('company');
        $estimate->save();

        return back()->with([
            'success_message' => 'linked Company to Estimate.'
        ]);
    }

    public function unlinkCompany($id){
        $estimate = Estimate::find($id);

        $estimate->company_id = null;
        $estimate->save();

        return back()->with([
            'success_message' => 'Unlinked Company to estimate.'
        ]);
    }

    public function destroy($id){
        $estimate = Estimate::all()->find($id);

        foreach ($estimate->products as $product){
        $product->delete();
        $product->description = 'deleted_'.time().'_'.$product->description;
        $product->save();
        }

        $estimate->delete();
        $estimate->number = 'deleted_'.time().'_'.$estimate->number;
        $estimate->sign_id = null;
        $estimate->save();
        return redirect('admin/estimates')->with([
            'success_message' => 'Deleted estimate'
        ])->setStatusCode(200);


    }

}
