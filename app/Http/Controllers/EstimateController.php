<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use App\Models\Client;
use App\Models\Products;
use Carbon\Carbon;
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
        $productTotal =[0];

        for ($i = 1; $i < $request->post('total_items')+1; $i++) {
            $noVatTotal = $request->post('price' . $i) * $request->post('amount' . $i);
            $vat = $noVatTotal / 100 * $request->post('vat' . $i);
            $vatTotal = $noVatTotal + $vat;
            $total = $total + $vatTotal;
            $productTotal[$i] = $total;
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
                'total' => $productTotal[$i],
            ]);
        }


        return redirect('/estimates');
    }

    public function show($id)
    {
        $estimate = Estimate::all()->find($id);
        if ($estimate->company_id = Auth::id()){
            $products = $estimate->products;
            $clients = Client::all()->where('company_id', Auth::id());

            return view('estimates.show', compact('estimate', 'products', 'clients'));
        }
        return back();
    }

    public function update(Request $request, $id)
    {
        $estimate = Estimate::all()->find($id);
        $products = Products::all()->where('estimate_id', '=', $id);

        $request->validate([
            'client' => 'required',
            'due_date' => 'required',
            'discount' => 'required',
            'total_items' => 'required',
        ]);

        $validate_array = [];
        for ($i = 1; $i < $request->post('total_items'); $i++) {

            $request->validate([
                'amount' . $i => 'required',
                'description' . $i => 'required',
                'vat' . $i => 'required',
                'price' . $i => 'required',
            ]);
        }


        $sign_id = Str::random(50);
        $total= (float) 0.00;
        $productTotal =[0];

        for ($i = 1; $i < $request->post('total_items')+1; $i++) {
            $noVatTotal = $request->post('price' . $i) * $request->post('amount' . $i);
            $vat = $noVatTotal / 100 * $request->post('vat' . $i);
            $vatTotal = $noVatTotal + $vat;
            $total = $total + $vatTotal;
            $productTotal[$i] = $total;
        }

        $amount = $total / 100 * $request->post('discount');
        $total = $total - $amount;

        $estimate->update([
            'title' => $request->post('title'),
            'sign_id' => $sign_id,
            'due_date' => $request->post('due_date'),
            'discount' => $request->post('discount'),
            'total' => $total,
            'amount' => $amount,
            'company_id' => Auth::id(),
            'client_id' => $request->post('client'),
        ]);

        $i = 0;

        foreach ($products as $product) {
            $i++;
            $product->update([
                'description' => $request->post('description' . $i),
                'amount' => $request->post('amount' . $i),
                'tax' => $request->post('vat' . $i),
                'price' => $request->post('price' . $i),
                'estimate_id' => $estimate->id,
                'discount' => $request->post('discount'),
                'total' => $productTotal[$i],
            ]);
        }

        return back();
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

    public function destroy($id){
        $estimate = Estimate::all()->find($id);

        foreach ($estimate->products as $product){
        $product->delete();
        $product->description = 'deleted_'.time().'_'.$product->description;
        $product->save();
        }

        $estimate->delete();
        $estimate->number = 'deleted_'.time().'_'.$estimate->number;
        $estimate->sign_id = null;
        $estimate->save();
        return response()->json([
            'message' => 'Deleted estimate'
        ])->setStatusCode(200)->redirectTo('/estimates');


    }
}
