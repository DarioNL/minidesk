<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use App\Notifications\credentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::all()->where('company_id', Auth::id());

        return view('clients.index', compact('clients'));
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
                Rule::unique('clients','email'),
                Rule::unique('admins','email')
            ],
        ]);


       $client = Client::create([
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
            $client->save();
            if ($request->post('send_login') == true) {
                $client->notify(new credentials($client, $password));
                return back();
            }
        }


        return redirect('/clients');
    }

    public function show($id)
    {
        $client = Client::all()->find($id);

        return view('clients.show', compact('client'));
    }

    public function search(Request $request)
    {
        $q = $request->post('q');
        $allClients = Client::search($q)->get();
        $clients = $allClients->where('company_id', Auth::id());

        return view('clients.index', compact('clients'));
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
            $password = Str::random(10);
            $client->password = bcrypt($password);
            $client->save();
            if ($request->post('send_login') == true) {
                $client->notify(new credentials($client, $password));
                return back();
            }
        }


        return back();
    }

    public function destroy($id){
        $client = Client::all()->find($id);
        $client->delete();
        $client->email = 'deleted_'.time().'_'.$client->email;
        $client->save();

        foreach ($client->Estimates as $estimate){
            $estimate->client_id = null;
            $estimate->save();
        }

        foreach ($client->invoices as $invoice){
            $invoice->client_id = null;
            $invoice->save();
        }


        return response()->json([
            'message' => 'Deleted client'
        ])->setStatusCode(200);

    }
}
