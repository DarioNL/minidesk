<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Company;
use App\Notifications\credentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminClientController extends Controller
{

    public function index()
    {
        $clients = Client::all();
        $companies = Company::all();

        return view('clients.index', compact('clients', 'companies'));
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
            'company_id' => $request->post('company'),
            'password' => bcrypt($password),
        ]);

        if ($request->has('send_login')) {
            $client->save();
            if ($request->post('send_login') == true) {
                $client->notify(new credentials($client, $password));
                return back();
            }
        }


        return redirect('admin/clients')->with([
            'success_message' => 'Created user.'
        ]);
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
                Rule::unique('clients','email')->ignore($client->id),
                 Rule::unique('admins','email')
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
            'company' => $request->post('company')
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


        return back()->with([
            'success_message' => 'Updated client.'
        ]);
    }

    public function unlink($id){
        $client = Client::find($id);
        $client->company_id = null;
        $client->save();
        return redirect('admin/clients')->with([
            'success_message' => 'Unlinked client.'
        ]);
    }

    public function link(Request $request, $id){
        $request->validate([
            'company' => 'required',
        ]);
        $client = Client::find($id);
        $client->company_id = $request->post('company');
        $client->save();
        return redirect('admin/clients')->with([
            'success_message' => 'Linked client.'
        ]);
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


        return redirect('/admin/clients')->with([
            'success_message' => 'Deleted client'
        ])->setStatusCode(200);

    }
}
