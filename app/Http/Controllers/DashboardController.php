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
        $user = Auth::id();
        $company = Company::all()->find($user);
        $clients = $company->clients;
        $estimates = $company->estimates;
        $invoices = $company->invoices;

        return view('home',  compact('clients', 'estimates', 'invoices'));
    }

}
