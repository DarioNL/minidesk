<?php

namespace App\Http\Controllers\client;

use App\Models\Estimate;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Products;
use App\Notifications\InvoicePaid;
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

    public function postSearch(Request $request)
    {
        $q = $request->post('q');
        $allInvoices = Invoice::search($q)->get();
        $invoices = $allInvoices->where('client_id', Auth::id());

        return view('invoices.index', compact('invoices'));
    }

    public function webhook()
    {

    }

    public function paid($id)
    {
        $invoice = Invoice::find($id);

        if ($invoice->pay_date != null) {
            return view('invoices.client.success', compact('invoice'));
        }

        return redirect('/dashboard');
    }


    public function success($id)
    {
        $invoice = Invoice::find($id);


            if ($invoice->pay_date == null) {
                Mollie::api()->setApiKey($invoice->company->mollie_key);
                $payment = Mollie::api()->payments()->get($invoice->payment_id);
                if ($payment->status == 'paid') {
                    $invoice->status = 'payed';
                    $invoice->pay_date = Carbon::now();
                    $invoice->save();
                $invoice->client->notify(new InvoicePaid($invoice, '#2ea44f'));
                    return redirect('client/invoices/' . $invoice->id . '/paid')->with([
                        'success_message' => 'Payed invoice.'
                    ]);
                }
                if ($payment->status == 'failed') {
                    $invoice->pay_id = null;
                    $invoice->status = 'failed';
                    $invoice->save();
                    return redirect('/dashboard')->withErrors([
                        'failed' => 'failed to pay invoice'
                    ]);
                }
                if ($payment->status == 'canceled') {
                    $invoice->pay_id = null;
                    $invoice->status = 'canceled';
                    $invoice->save();
                    return redirect('/dashboard')->with([
                        'success_message' => 'Canceled invoice'
                    ]);
                }
            }
            return redirect('/dashboard')->withErrors([
                'Already payed' => 'Invoice is already payed.'
            ]);
    }
}
