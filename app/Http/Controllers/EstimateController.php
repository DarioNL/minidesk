<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use App\Models\Client;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class EstimateController extends Controller
{

    public function index()
    {
        $estimates = Estimate::all()->where('company_id', Auth::id());
        $clients = Client::all()->where('company_id', Auth::id());

        return view('estimates.index', compact('estimates', 'clients'));
    }

    public function postCreate(Request $request)
    {



        $request->validate([
            'client' => 'required',
            'due_date' => 'required',
            'discount' => 'required',
            'total_items' => 'required',
        ]);

        $validate_array = [];
        for ($i = 1; $i < $request->post('total_items')+1; $i++) {

            $request->validate([
                'amount' . $i => 'required',
                'description' . $i => 'required',
                'vat' . $i => 'required',
                'price' . $i => 'required',
            ]);
        }


        $sign_id = Str::random(50);
        $total= (float) 0.00;

        for ($i = 1; $i < $request->post('total_items')+1; $i++) {
            $noVatTotal = $request->post('price' . $i) * $request->post('amount' . $i);
            $vat = $noVatTotal / 100 * $request->post('vat' . $i);
            $vatTotal = $noVatTotal + $vat;
            $total = $total + $vatTotal;
        }

        $amount = $total / 100 * $request->post('discount');
        $total = $total - $amount;

        $estimate = Estimate::create([
            'title' => $request->post('title'),
            'sign_id' => $sign_id,
            'due_date' => $request->post('due_date'),
            'discount' => $request->post('discount'),
            'total' => $total,
            'amount' => $amount,
            'company_id' => Auth::id(),
            'client_id' => $request->post('client'),
        ]);

        for ($i = 1; $i < $request->post('total_items')+1; $i++) {
            Products::create([
                'description' => $request->post('description' . $i),
                'amount' => $request->post('amount' . $i),
                'tax' => $request->post('vat' . $i),
                'price' => $request->post('price' . $i),
                'estimate_id' => $estimate->id,
                'discount' => $request->post('discount'),
                'total' => $total,
            ]);
        }


        return redirect('/estimates');
    }

    public function show($id)
    {
        $client = Client::all()->find($id);

        return view('clients.show', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = Client::all()->find($id);

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'house_number' => 'required',
            'phone' => 'required',
            'email' => [
                Rule::unique('companies','email'),
                Rule::unique('clients','email')->ignore($client->id)
            ],
        ]);

        if ($client->email != $request->post('email')) {
            $client->email_verified_at = null;
            $client->save();
        }


        $client->update([
            'first_name' => $request->post('first_name'),
            'last_name' => $request->post('last_name'),
            'address' => $request->post('address'),
            'zipcode' => $request->post('zipcode'),
            'house_number_suffix' => $request->post('house_number_suffix'),
            'city' => $request->post('city'),
            'house_number' => $request->post('house_number'),
            'phone' => $request->post('phone'),
            'email' => $request->post('email'),
            'logo' => $request->post('logo'),
        ]);

        if ($request->has('send_login')) {
//            if ($request->post('send_login') == true) {
//                $user->sendLoginInfo($user->email, $password);
//            }
        }


        return back();
    }

    public function destroy($id){
        $client = Client::all()->find($id);
        $client->delete();
        $client->email = 'deleted_'.time().'_'.$client->email;
        $client->save();
        return response()->json([
            'message' => 'Deleted client'
        ])->setStatusCode(200);

    }
}
