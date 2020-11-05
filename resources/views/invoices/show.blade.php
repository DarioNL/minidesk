@extends('layouts.app')

@section('content')

    @auth('web')
        @include('invoices.delete', ['invoice' => $invoice])
        @include('invoices.edit', ['invoice' => $invoice])
        @include('invoices.send', ['invoice' => $invoice])
    @elseauth('admins')
        @include('invoices.delete', ['invoice' => $invoice])
        @include('invoices.edit', ['invoice' => $invoice, 'companies' => $companies])
        @include('invoices.send', ['invoice' => $invoice])
    @endauth



    <div class="card table-container align-items-center w-100">
        <div class="w-100 border-bottom p-2">
            <div class="float-left">
                <h3 class="float-left pt-2">Invoice @if($invoice->title != null){{$invoice->title}}@else{{$invoice->number}}@endif</h3>
            </div>
        </div>
        <div class="card-body w-100 pt-2">
            <div class="text-secondary mb-5">
                <h5 class="float-left text-muted mr-2 mt-1 desktoptd">
                    @if(!$invoice->pay_date)
                        <h5 class="float-left text-danger mr-2 mt-1 desktoptd">
                            {{$invoice->pay_date ? 'Accepted' : 'Unaccepted'}}
                        </h5>
                    @else
                        <h5 class="float-left text-success mr-2 mt-1 desktoptd">
                            {{$invoice->pay_date ? 'Accepted' : 'Unaccepted'}}
                        </h5>
                    @endif
                </h5>
            </div>
            <div>
                @php($date = explode(' ', $invoice->send_date))
                <h5 class="float-left text-muted mr-2 desktoptd">
                    <i class="uil uil-envelope"></i> @if($invoice->send_date != null)Send On : {{$date[0]}}@else Not send @endif
                </h5>
            </div>
            <div class="float-right mb-3">
                @auth('web')
                    <a href="/company/clients/{{$invoice->client_id}}" class="col-sm-12 col-md-auto btn btn-secondary"><i class="uil uil-eye"></i> View Client</a>
                    <button onclick="$('#deleteModal').modal('show')" class="col-sm-12 col-md-auto btn btn-danger"> <i class="uil uil-trash-alt"></i> Delete</button>
                    <a class="btn btn-info text-white col-md-auto col-sm-12"><i class=" uil uil-print"></i> Print</a>
                    <button onclick="$('#sendModal').modal('show')" class="col-sm-12 col-md-auto btn btn-primary text-white"><i class="uil uil-envelope-upload"></i> @if($invoice->send_date != null)Send Reminder Mail @else Send Mail @endif</button>
                    <button onclick="$('#editModal').modal('show')" class="col-sm-12 col-md-auto btn btn-warning text-white"><i class="uil uil-edit"></i> Edit</button>
                @elseauth('admins')
                    <a href="/company/clients/{{$invoice->client_id}}" class="col-sm-12 col-md-auto btn btn-secondary"><i class="uil uil-eye"></i> View Client</a>
                    <button onclick="$('#deleteModal').modal('show')" class="col-sm-12 col-md-auto btn btn-danger"> <i class="uil uil-trash-alt"></i> Delete</button>
                    <a class="btn btn-info text-white col-md-auto col-sm-12"><i class="uil uil-print"></i> Print</a>
                    <button onclick="$('#sendModal').modal('show')" class="col-sm-12 col-md-auto btn btn-primary text-white"><i class="uil uil-envelope-upload"></i> @if($invoice->send_date != null)Send Reminder Mail @else Send Mail @endif</button>
                    <button onclick="$('#editModal').modal('show')" class="col-sm-12 col-md-auto btn btn-warning text-white"><i class="uil uil-edit"></i> Edit</button>
                @else
                    @if(!$invoice->pay_date)
                        <a class="btn btn-success col-sm-12" href="{{$invoice->pay_id}}"> <i class="uil uil-wallet"></i> Pay</a>
                    @endif
                @endauth
            </div>
            <div class="w-100 float-right border-bottom border-top">
                <h5 class="pt-3 pb-3">
                Pay Url = {{$invoice->pay_id ? $invoice->pay_id : 'Not Send'}}
                </h5>
            </div>
            <div class="w-100 float-right">
                <h4 class="pt-3 pb-3">
                    <i class="uil uil-bag"></i>  {{$invoice->Company->name ?? 'No company'}}
                </h4>
                @php($dueDate = explode(' ', $invoice->due_date))
                <h5 class="pt-3 float-right pb-3">
                    <i class="uil uil-calendar-alt"></i>  {{$dueDate[0]}}
                </h5>
                <h4 class="pt-3 pb-3">
                    <i class="uil uil-user"></i>  {{$invoice->Client->first_name?? 'No client'}} {{$invoice->Client->last_name?? 'No client'}}
                </h4>
                <h5 class="pt-3 text-muted">
                    <i class="uil uil-location-point"></i>  {{$invoice->Company->address ?? 'No company'}} {{$invoice->Company->house_number ?? ''}}
                </h5>
                <h5 class="text-muted border-bottom pb-3">
                    {{$invoice->Company->zipcode ?? 'No company'}} {{$invoice->Company->city ?? ''}}
                </h5>
            </div>
            <div class="card-text">
                <table class="w-100 border-bottom border-top">
                    <tr class="border-bottom text-white table-header" style="box-shadow: none !important; font-weight: normal">
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Tax</th>
                        <th>Total</th>
                    </tr>
                    <tbody id="append_hook">
                    @foreach($products as $product)
                        <tr class="border-bottom">
                            <td>
                                {{$product->amount}}
                            </td>
                            <td>
                                {{$product->description}}
                            </td>
                            <td>
                                €{{$product->price}}
                            </td>
                            <td>
                                {{$product->tax}}%
                            </td>
                            <td>
                                €{{$product->total}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="w-100">
                <h5 class="pt-3 float-right pb-3">
                    Discount {{$invoice->discount}}% -€{{$invoice->amount}}
                </h5>
                </div>
            </div>
        </div>
        <div class="w-100 border-top pt-3">
            <h4 class="p-3 float-right">
                Total €{{$invoice->total}}
            </h4>
        </div>
    </div>

@stop
