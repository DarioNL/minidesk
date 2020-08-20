<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        if (Auth::guard('web')->check()) {
            $user = Auth::id();
            $company = Company::find($user);
            $clients = $company->clients;
            $estimates = $company->estimates;
            $acceptedEstimates = $estimates->where('sign_date', '!=', null);
            $invoices = $company->invoices;
            $acceptedInvoices = $invoices->where('pay_date', '!=', null);

            return view('home', compact('clients', 'estimates', 'invoices', 'acceptedEstimates', 'acceptedInvoices'));
        }
        $user = Auth::id();
        $client = Client::find($user);
        $company = $client->company;
        $estimates = $client->Estimates;
        $acceptedEstimates = $estimates->where('sign_date', '!=', null);
        $invoices = $client->Invoices;
        $acceptedInvoices = $invoices->where('pay_date', '!=', null);
        return view('home', compact('client', 'estimates', 'invoices', 'acceptedInvoices', 'acceptedEstimates'));
    }

}
