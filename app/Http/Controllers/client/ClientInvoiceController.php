<?php

namespace App\Http\Controllers\client;

use App\Models\Estimate;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ClientInvoiceController extends client
{

    public function index()
    {
        $client = Client::find(Auth::id());
        $invoices = $client->Invoices->where('send_date', '!=', null);

        return view('invoices.index', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = Invoice::find($id);
        if ($invoice->client_id = Auth::id()){
            $products = $invoice->products;

            return view('invoices.show', compact('invoice', 'products'));
        }
        return back();
    }

    public function sign($id)
    {
        $estimate = Estimate::where('sign_id', '=', $id);
        $estimate = $estimate[0];


        return view('estimates.client.sign',  compact('estimate'));
    }

    public function accept(Request $request,$id){
         $request->validate([
            'password' => 'required',
            'email' => 'required',
            'first_name' => 'required',
             Rule::exists('clients', 'first_name'),
            'last_name' => 'required',
             Rule::exists('clients', 'last_name'),
             'sign' => 'required'
        ]);
        $estimate = Estimate::all()->find($id);

        if (Auth::guard('clients')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('clients')->user();
            $user->last_login = date('Y-m-d H:i:s');
            $user->save();
            $estimate->sign_date = Carbon::now();
            $estimate->sign_id = null;
            $estimate->number = '#of' . random_int(0, 9) . random_int(0, 9) . random_int(0, 9) . random_int(0, 9);
            $estimate->save();

            $invoice = Invoice::create([
                'title' => $estimate->title,
                'due_date' => $estimate->due_date,
                'discount' => $estimate->discount,
                'total' => $estimate->total,
                'amount' => $estimate->amount,
                'company_id' => $estimate->company_id,
                'client_id' => $estimate->client_id,
            ]);
            foreach ($estimate->products as $product) {
                $product->invoice_id = $invoice->id;
                $product->save();
            }
            return redirect()->to('/dashboard');
        }
            return back()->onlyInput();
    }

}
