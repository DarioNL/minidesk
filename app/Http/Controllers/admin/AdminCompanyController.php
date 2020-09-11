<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Notifications\credentials;
use Carbon\Carbon;
use Faker\Provider\File;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $logoPath = 'images/';
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
           'password' => bcrypt($password),
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
        $company = Company::find($id);


        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'house_number' => 'required',
            'phone' => 'required',
            'logo' => ['image', 'mimes:jpg,jpeg,bmp,svg,png', 'max:5000'],
            'email' => [
                Rule::unique('companies','email')->ignore($company->id),
                Rule::unique('clients','email'),
                Rule::unique('admins','email')
            ],
            'vat_number' => 'required|min:9|max:9',
        ]);





        $company->update([
            'name' => $request->post('name'),
            'address' => $request->post('address'),
            'zipcode' => $request->post('zipcode'),
            'city' => $request->post('city'),
            'house_number' => $request->post('house_number'),
            'phone' => $request->post('phone'),
            'email' => $request->post('email'),
            'vat_number' => $request->post('vat_number'),
            'mollie_key' => $request->post('mollie_key'),
        ]);


        if ($request->file('logo')){
            Storage::delete($company->logo);
            $logoUpload = $request->file('logo');
            $logoName = time() . '.' . $logoUpload->getClientOriginalExtension();
            $logoPath = 'images/';
            $logoUpload->move($logoPath, $logoName);

            $company->logo = $logoPath.$logoName;
            $company->save();
        }

        if ($request->has('send_login')) {
            $password = Str::random(10);
            $company->password = bcrypt($password);
            $company->save();
            if ($request->post('send_login') == true) {
                $company->notify(new credentials($company, $password));
                return redirect('admin/companies');
            }
        }


        return redirect('admin/companies');
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
