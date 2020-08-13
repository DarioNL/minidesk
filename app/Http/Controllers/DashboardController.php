<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        if (Auth::guard('web')->check()) {
            $user = Auth::id();
            $company = Company::find($user);
            $clients = $company->clients;
            $estimates = $company->estimates;
            $invoices = $company->invoices;

            return view('home', compact('clients', 'estimates', 'invoices'));
        }
        $user = Auth::id();
        $client = Client::find($user);
        $company = $client->company;
        $estimates = $client->Estimates;
        $invoices = $client->Invoices;
        return view('home', compact('client', 'estimates', 'invoices'));
    }

}
