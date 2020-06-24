<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use App\Models\Client;
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
        $password = Str::random(10);


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
                Rule::unique('clients','email')
            ],
        ]);


        Client::create([
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
            'company_id' => Auth::id(),
            'password' => bcrypt($password),
        ]);

        if ($request->has('send_login')) {
//            if ($request->post('send_login') == true) {
//                $user->sendLoginInfo($user->email, $password);
//            }
        }


        return redirect('/clients');
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
