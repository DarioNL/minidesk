<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Company;
use App\Models\Estimate;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        if (Auth::guard('web')->check()) {
            $user = Auth::id();
            $company = Company::find($user);
            $clients = $company->clients;
            $estimates = $company->estimates;
            $acceptedEstimates = $estimates->where('sign_date', '!=', null);
            $invoices = $company->invoices;
            $acceptedInvoices = $invoices->where('pay_date', '!=', null);

            $estimatesPercent = count($acceptedEstimates) / count($estimates) * 100;
            $invoicesPercent = count($acceptedInvoices) / count($invoices) * 100;

            return view('home', compact('clients', 'estimates', 'invoices', 'acceptedEstimates', 'acceptedInvoices', 'estimatesPercent', 'invoicesPercent'));
        }
        if (Auth::guard('admins')->check()) {
            $clients = Client::all();
            $companies = Company::all();
            $estimates = Estimate::all();
            $acceptedEstimates = $estimates->where('sign_date', '!=', null);
            $invoices = Invoice::all();
            $acceptedInvoices = $invoices->where('pay_date', '!=', null);

            if (count($estimates) != 0) {
                $estimatesPercent = count($acceptedEstimates) / count($estimates) * 100;
            } else {
                $estimatesPercent = 0;
            }
            if (count($invoices) != 0) {
                $invoicesPercent = count($acceptedInvoices) / count($invoices) * 100;
            } else {
                $invoicesPercent = 0;
            }

            return view('home', compact('clients', 'estimates', 'invoices', 'acceptedEstimates', 'acceptedInvoices', 'companies', 'estimatesPercent', 'invoicesPercent'));
        }

        $user = Auth::id();
        $client = Client::find($user);
        $company = $client->company;
        $estimates = $client->Estimates;
        $acceptedEstimates = $estimates->where('sign_date', '!=', null);
        $invoices = $client->Invoices;
        $acceptedInvoices = $invoices->where('pay_date', '!=', null);

        $estimatesPercent = count($acceptedEstimates) / count($estimates) * 100;
        $invoicesPercent = count($acceptedInvoices) / count($invoices) * 100;
        return view('home', compact('client', 'estimates', 'invoices', 'acceptedInvoices', 'acceptedEstimates', 'estimatesPercent', 'invoicesPercent'));
    }


    public function settings()
    {
        $user = Auth::id();

        if (Auth::guard('clients')->check()) {
            $client = Client::find($user);
            return view('settings', compact('client'));
        }

        if (Auth::guard('web')->check()) {
            $company = Company::find($user);
            return view('settings', compact('company'));
        }

        if (Auth::guard('admins')->check()) {
            $admin = Admin::find($user);
            return view('settings', compact('admin'));
        }

    }

    public function store(Request $request, $id)
    {
            if ($id = Auth::id()) {
                if (Auth::guard('admins')->check()) {
                    $request->validate([
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'email' => [
                            Rule::unique('companies', 'email'),
                            Rule::unique('clients', 'email'),
                            Rule::unique('admins', 'email')->ignore($id)
                        ],
                    ]);
                    $admin = Admin::find($id);
                    $admin->update([
                        'first_name' => $request->post('first_name'),
                        'last_name' => $request->post('last_name'),
                        'email' => $request->post('email'),
                    ]);

                    return redirect('/settings');
                }

                if (Auth::guard('web')->check()) {
                    $request->validate([
                        'name' => 'required',
                        'address' => 'required',
                        'zipcode' => 'required',
                        'city' => 'required',
                        'house_number' => 'required',
                        'phone' => 'required',
                        'email' => [
                            Rule::unique('companies', 'email')->ignore($id),
                            Rule::unique('clients', 'email'),
                            Rule::unique('admins', 'email')
                        ],
                        'vat_number' => 'required|min:9|max:9',
                    ]);
                    $company = Company::find($id);
                    $company->update([
                        'name' => $request->post('name'),
                        'address' => $request->post('address'),
                        'zipcode' => $request->post('zipcode'),
                        'house_number_suffix' => $request->post('house_number_suffix'),
                        'city' => $request->post('city'),
                        'house_number' => $request->post('house_number'),
                        'phone' => $request->post('phone'),
                        'email' => $request->post('email'),
                        'vat_number' => $request->post('vat_number'),
                    ]);
                    return redirect('/settings');
                }

                if (Auth::guard('client')->check()) {
                    $request->validate([
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'address' => 'required',
                        'zipcode' => 'required',
                        'city' => 'required',
                        'house_number' => 'required',
                        'phone' => 'required',
                        'email' => [
                            Rule::unique('companies', 'email'),
                            Rule::unique('clients', 'email')->ignore($id),
                            Rule::unique('admins', 'email')
                        ],
                    ]);
                    $client = Client::find($id);
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
                    ]);
                    return redirect('/settings');
                }
                return back()->withErrors();
            }
    }

    public function storeLogo(Request $request, $id)
    {
        if ($id = Auth::id()) {
            if (Auth::guard('clients')->check()) {
                $request->validate([
                    'logo' => ['required', 'image', 'mimes:jpg,jpeg,bmp,svg,png', 'max:5000'],
                ]);
                $logoUpload = $request->file('logo');
                $logoName = time().'.'.$logoUpload->getClientOriginalExtension();
                $logoPath = public_path('/images/');
                $logoUpload->move($logoPath, $logoName);
                $client = Client::find($id);
                if ($client->logo) {
                    unlink(public_path($admin->logo));
                }
                $client->logo = $logoName;
                $client->save();

                return redirect('/settings');
            }

            if (Auth::guard('web')->check()) {
                $request->validate([
                    'logo' => ['required', 'image', 'mimes:jpg,jpeg,bmp,svg,png', 'max:5000'],
                ]);
                $logoUpload = $request->file('logo');
                $logoName = time().'.'.$logoUpload->getClientOriginalExtension();
                $logoPath = public_path('/images/');
                $logoUpload->move($logoPath, $logoName);
                $company = Company::find($id);
                if ($company->logo) {
                    unlink(public_path($admin->logo));
                }
                $company->logo = $logoName;
                $company->save();

                return redirect('/settings');
            }

            if (Auth::guard('admins')->check()) {
                $request->validate([
                    'logo' => ['required', 'image', 'mimes:jpg,jpeg,bmp,svg,png', 'max:5000'],
                ]);
                $logoUpload = $request->file('logo');
                $logoName = time().'.'.$logoUpload->getClientOriginalExtension();
                $logoPath = public_path('/images/');
                $logoUpload->move($logoPath, $logoName);
                $admin = Admin::find($id);
                if ($admin->logo) {
                    unlink(public_path($admin->logo));
                }
                $admin->logo = '/images/'.$logoName;
                $admin->save();


                return redirect('/settings');
            }
        }
        return back()->withErrors();
    }

    public function changePassword(Request $request, $id)
    {
        if ($id = Auth::id()) {
            if (Auth::guard('clients')->check()) {
                $request->validate([
                    'password' => 'required',
                    'password_confirm' => 'required_with:password|same:password|min:6'
                ]);
                $client = Client::find($id);
                $client->password = bcrypt($request->post('password'));
                $client->save();

                return redirect('/settings');
            }

            if (Auth::guard('web')->check()) {
                $request->validate([
                    'password' => 'required',
                    'password_confirm' => 'required_with:password|same:password|min:6'
                ]);
                $company = Company::find($id);
                $company->password = bcrypt($request->post('password'));
                $company->save();

                return redirect('/settings');
            }

            if (Auth::guard('admins')->check()) {
                $request->validate([
                    'password' => 'required',
                    'password_confirm' => 'required_with:password|same:password|min:6'
                ]);
                $admin = Admin::find($id);
                $admin->password = bcrypt($request->post('password'));
                $admin->save();

                return redirect('/settings');
            }
        }
        return back()->withErrors();
    }



}


