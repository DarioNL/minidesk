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
use Mollie\Laravel\Facades\Mollie;

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
        if ($invoice->client_id = Auth::id()) {
            $products = $invoice->products;

            return view('invoices.show', compact('invoice', 'products'));
        }
        return back();
    }

    public function webhook()
    {

    }


    public function success($id)
    {
        $invoice = Invoice::find($id);
        if ($invoice->pay_date == null) {
            Mollie::api()->setApiKey($invoice->company->mollie_key);
            $payment = Mollie::api()->payments()->get($invoice->payment_id);
            if ($payment->status = 'paid') {
                $invoice->pay_date = Carbon::now();
                $invoice->save();
//                $invoice->client->notify(new sendInvoice($invoice, '#2ea44f'));
                return redirect('/dashboard');
            }
        }
        return redirect('/dashboard');
    }

}
