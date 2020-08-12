@extends('layouts.app')

@section('content')

    @include('estimates.delete', ['estimate' => $estimate])
    @include('estimates.edit', ['estimate' => $estimate])
    @include('estimates.accept', ['estimate' => $estimate])
    @include('estimates.send', ['estimate' => $estimate])


    <div class="card table-container align-items-center w-100">
        <div class="w-100 border-bottom p-2">
            <div class="float-left">
                <h3 class="float-left pt-2">Estimate @if($estimate->title != null){{$estimate->title}}@else{{$estimate->number}}@endif</h3>
            </div>
        </div>
        <div class="card-body w-100 pt-2">
            <div class="text-secondary mb-5 text-muted">
                <h5 class="float-left text-muted mr-2 mt-1 desktoptd">
                    {{$estimate->sign_date ? 'Accepted' : 'Unaccepted'}}
                </h5>
            </div>
            <div>
                @php($date = explode(' ', $estimate->send_date))
                <h5 class="float-left text-muted mr-2 desktoptd">
                    <i class="uil uil-envelope"></i> @if($estimate->send_date != null)Send On : {{ $date[0]}}@else Not send @endif
                </h5>
            </div>
            <div class="float-right mb-3">
                <a href="/clients/{{$estimate->client_id}}" class="btn btn-secondary"><i class="uil uil-eye"></i> View Client</a>
                <button onclick="$('#deleteModal').modal('show')" class="btn btn-danger"> <i class="uil uil-trash-alt"></i> Delete</button>
                <button onclick="$('#acceptModal').modal('show')" class="btn btn-success text-white"><i class="uil uil-check-square"></i> Mark As Accepted</button>
                <button onclick="" class="btn btn-info text-white"><i class="uil uil-print"></i> Print</button>
                <button onclick="$('#sendModal').modal('show')" class="btn btn-primary text-white"><i class="uil uil-envelope-upload"></i> @if($estimate->send_date != null)Send Reminder Mail @else Send Mail @endif</button>
                <button onclick="$('#editModal').modal('show')" class="btn btn-warning text-white"><i class="uil uil-edit"></i> Edit</button>
            </div>
            <div class="w-100 float-right border-bottom border-top">
                <h5 class="pt-3 pb-3">
                Sign Url = @if($estimate->sign_id != null){{env('APP_URL')}}/sign-estimate/{{$estimate->sign_id}}@else This document has already been accepted.@endif
                </h5>
            </div>
            <div class="w-100 float-right">
                <h5 class="pt-3 float-right pb-3">
                    <i class="uil uil-envelope"></i>  {{$date[0] ? $date[0] : 'Not Send'}}
                </h5>
                <h4 class="pt-3 pb-3">
                    <i class="uil uil-bag"></i>  {{$estimate->company->name}}
                </h4>
                @php($dueDate = explode(' ', $estimate->due_date))
                <h5 class="pt-3 float-right pb-3">
                    <i class="uil uil-calendar-alt"></i>  {{$dueDate[0]}}
                </h5>
                <h4 class="pt-3 pb-3">
                    <i class="uil uil-user"></i>  {{$estimate->client->first_name}} {{$estimate->client->last_name}}
                </h4>
                <h5 class="pt-3 text-muted">
                    <i class="uil uil-location-point"></i>  {{$estimate->company->address}} {{$estimate->company->house_number}}
                </h5>
                <h5 class="text-muted border-bottom pb-3">
                    {{$estimate->company->zipcode}} {{$estimate->company->city}}
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
                    Discount {{$estimate->discount}}% -€{{$estimate->amount}}
                </h5>
                </div>
            </div>
        </div>
        <div class="w-100 border-top pt-3">
            <h4 class="p-3 float-right">
                Total €{{$estimate->total}}
            </h4>
        </div>
    </div>

@stop
