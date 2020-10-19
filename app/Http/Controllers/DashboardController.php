<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Company;
use App\Models\Estimate;
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

            $estimatesPercent = count($acceptedEstimates) / count($estimates) * 100;
            $invoicesPercent = count($acceptedInvoices) / count($invoices) * 100;

            return view('home', compact('clients', 'estimates', 'invoices', 'acceptedEstimates', 'acceptedInvoices', 'estimatesPercent', 'invoicesPercent'));
        }
        if (Auth::guard('admins')->check()) {
            $clients = Client::all();
            $companies = Company::all();
            $estimates = Estimate::all();
            $acceptedEstimates = $estimates->where('sign_date', '!=', null);
            $invoices = Invoice::all();
            $acceptedInvoices = $invoices->where('pay_date', '!=', null);

            if (count($estimates) != 0) {
                $estimatesPercent = count($acceptedEstimates) / count($estimates) * 100;
            } else {
                $estimatesPercent = 0;
            }
            if (count($invoices) != 0) {
                $invoicesPercent = count($acceptedInvoices) / count($invoices) * 100;
            } else {
                $invoicesPercent = 0;
            }

            return view('home', compact('clients', 'estimates', 'invoices', 'acceptedEstimates', 'acceptedInvoices', 'companies', 'estimatesPercent', 'invoicesPercent'));
        }

        $user = Auth::id();
        $client = Client::find($user);
        $company = $client->company;
        $estimates = $client->Estimates;
        $acceptedEstimates = $estimates->where('sign_date', '!=', null);
        $invoices = $client->Invoices;
        $acceptedInvoices = $invoices->where('pay_date', '!=', null);

        $estimatesPercent = count($acceptedEstimates) / count($estimates) * 100;
        $invoicesPercent = count($acceptedInvoices) / count($invoices) * 100;
        return view('home', compact('client', 'estimates', 'invoices', 'acceptedInvoices', 'acceptedEstimates', 'estimatesPercent', 'invoicesPercent'));
    }


    public function settings()
    {
        $user = Auth::id();

        if (Auth::guard('clients')->check()) {
            $client = Client::find($user);
            return view('settings', compact('client'));
        }

        if (Auth::guard('web')->check()) {
            $company = Company::find($user);
            return view('settings', compact('company'));
        }

        if (Auth::guard('admins')->check()) {
            $admin = Admin::find($user);
            return view('settings', compact('admin'));
        }


    }

}


