<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{

    public function showRegistrationForm()
    {
      return view('auth.register');
    }

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'house_number' => 'required',
            'phone' => 'required',
            'password' => 'required',
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
        $logoPath = public_path('/images/');
        $logoUpload->move($logoPath, $logoName);


        Company::create([
            'name' => $request->post('name'),
            'address' => $request->post('address'),
            'zipcode' => $request->post('zipcode'),
            'city' => $request->post('city'),
            'house_number' => $request->post('house_number'),
            'phone' => $request->post('phone'),
            'email' => $request->post('email'),
            'logo' => $logoPath.$logoName,
            'vat_number' => $request->post('vat_number'),
            'password' => bcrypt($request->post('password')),
        ]);

        $usr = Auth::guard('web')->attempt(['email' => $request->post('email'), 'password' => $request->post('password')]);
        if ($usr) {
            $user = Auth::guard()->user();
            $user->last_login = date('Y-m-d H:i:s');
            $user->save();
            return redirect()->to('/dashboard');
        }

    }
}
