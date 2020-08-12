<?php

namespace App\Http\Controllers\client;

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

class ClientInvoiceController extends client
{
    public function index()
    {
        $invoices = Invoice::all()->where('client_id', Auth::id());

        return view('invoices.index', compact('invoices'));
    }



    public function show($id)
    {
        $invoice = Invoice::all()->find($id);
        if ($invoice->company_id = Auth::id()){
            $products = $invoice->products;

            return view('invoices.show', compact('invoice', 'products'));
        }
        return back();
    }

    public function success($id, $payment_id)
    {
        $payment = Mollie::api()->payments()->get('');
        dd($payment);
        $invoice = Invoice::find($id);
        $invoice->pay_dat = Carbon::now();
        $invoice->save();
        $invoice->client->notify(new sendInvoice($invoice, '#2ea44f'));
        return redirect('/clients/show/'.$invoice->id);
    }
}
