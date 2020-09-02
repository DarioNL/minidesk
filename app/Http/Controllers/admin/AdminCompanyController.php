<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Notifications\credentials;
use Carbon\Carbon;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminCompanyController extends Controller
{

    public function index()
    {
        $companies = Company::all();

        return view('companies.index', compact('companies'));
    }

    public function postCreate(Request $request)
    {
        $password = Str::random(10);


        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'house_number' => 'required',
            'phone' => 'required',
            'logo' => ['required', 'image', 'mimes:jpg,jpeg,bmp,svg,png', 'max:5000'],
            'email' => [
                Rule::unique('companies','email'),
                Rule::unique('clients','email'),
                Rule::unique('admins','email')
            ],
            'vat_number' => 'required|min:9|max:9',
        ]);

        $logoUpload = $request->file('logo');
        $logoName = time().'.'.$logoUpload->getClientOriginalExtension();
        $logoPath = '/images/';
        $logoUpload->move($logoPath, $logoName);


       $company = Company::create([
           'name' => $request->post('name'),
           'address' => $request->post('address'),
           'zipcode' => $request->post('zipcode'),
           'city' => $request->post('city'),
           'house_number' => $request->post('house_number'),
           'phone' => $request->post('phone'),
           'email' => $request->post('email'),
           'logo' => $logoPath.$logoName,
           'vat_number' => $request->post('vat_number'),
           'mollie_key' => $request->post('mollie_key'),
           'password' => bcrypt($request->post('password')),
        ]);

        if ($request->has('send_login')) {
            $company->email_verified_at = Carbon::now();
            $company->save();
            if ($request->post('send_login') == true) {
                $company->notify(new credentials($company, $password));
                return back();
            }
        }


        return redirect('/companies');
    }

    public function show($id)
    {
        $company = Company::all()->find($id);

        return view('companies.show', compact('company'));
    }

    public function search(Request $request)
    {
        $q = $request->post('q');
        $allCompanies = Company::search($q)->get();
        $companies = $allCompanies->where('company_id', Auth::id());

        return view('companies.index', compact('companies'));
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
        $company = Company::all()->find($id);
        $company->delete();
        $company->email = 'deleted_'.time().'_'.$company->email;
        $company->save();

        foreach ($company->Estimates as $estimate){
            $estimate->company_id = null;
            $estimate->save();
        }

        foreach ($company->invoices as $invoice){
            $invoice->company_id = null;
            $invoice->save();
        }


        return response()->json([
            'message' => 'Deleted company'
        ])->setStatusCode(200);

    }
}
