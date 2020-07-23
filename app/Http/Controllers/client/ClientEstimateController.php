<?php

namespace App\Http\Controllers\client;

use App\Models\Estimate;
use App\Models\Client;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ClientEstimateController extends client
{

    public function index()
    {
        $estimates = Estimate::all()->where('client_id', Auth::id());

        return view('estimates.index', compact('estimates'));
    }

    public function show($id)
    {
        $estimate = Estimate::all()->find($id);
        if ($estimate->client_id = Auth::id()){
            $products = $estimate->products;

            return view('estimates.show', compact('estimate', 'products'));
        }
        return back();
    }

    public function sign($id)
    {
        $estimate = Estimate::all()->where('sign_id', '=', $id);
        $estimate = $estimate[0];


        return view('estimates.client.sign',  compact('estimate'));
    }

    public function accept($id){
        $estimate = Estimate::all()->find($id);
        if ($estimate->sign_date = null){
            $estimate->sign_date = Carbon::now();
            $estimate->number = '#of'.random_int(0, 9).random_int(0, 9).random_int(0, 9).random_int(0, 9);
            $estimate->save();
        }

        return back();
    }

}
