<?php

namespace App\Http\Controllers\client;

use App\Models\Client;
use App\Models\Company;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientDashboardController extends client
{

    public function index()
    {
        $user = Auth::id();
        $client = Client::all()->find($user);
        $company = $client->company;
        $estimates = $client->estimates;
        $invoices = $client->invoices;

        return view('home',  compact('company', 'estimates', 'invoices'));
    }

}
