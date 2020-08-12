@extends('layouts.app')

@section('content')

    @include('clients.delete', ['client' => $client])
    @include('clients.edit', ['client' => $client])

    <div class="card">
        <div class="card-body pt-2">
            <div class="card-title mb-5 text-muted">
                <h3 class="float-left">{{$client->name}}</h3>
            </div>
            <div class="card-text">
                <div class="row">
                    <div class="col-6">
                        <p class="text-muted font-weight-bolder">Name</p>
                        {{$client->first_name}} {{$client->last_name}}
                        <div class="text-muted">{{$client->company_name}}</div>
                    </div>
                    <div class="col-6">
                        <p class="text-muted font-weight-bolder">Email</p>
                        {{$client->email}}
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-6">
                        <p class="text-muted font-weight-bolder">Address</p>
                        {{$client->address ?? '-'}}  {{$client->house_number}}{{$client->house_number_suffix}}
                    </div>
                    <div class="col-6">
                        <p class="text-muted font-weight-bolder">Zipcode</p>
                        {{$client->zipcode ?? '-'}}
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-6">
                        <p class="text-muted font-weight-bolder">Company</p>
                        @if($client->company->logo != null and $client->company != null)
                            <img src="{{asset('/images/'.$client->company->id.$client->company->logo.'')}}" class="user-profile-img rounded-circle" alt="{{asset('/images/blank_profile_picture.png')}}">
                        @else
                            <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
                        @endif {{ $client->Company->name ?? '-'}}
                    </div>
                    <div class="col-6">
                        <p class="text-muted font-weight-bolder">City</p>
                        {{$client->city ?? '-'}}
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-6">
                        <p class="text-muted font-weight-bolder">Phone</p>
                        {{$client->phone ?? '-'}}
                    </div>
                    <div class="col-6">
                        <p></p>
                        <a onclick="$('#editModal').modal('show')"
                           class="btn btn-secondary text-white float-right w-25 desktoptd">Edit</a>

                        <a onclick="$('#deleteModal').modal('show')"
                           class="btn btn-danger text-white mr-2 float-right w-25 desktoptd">Delete</a>
                    </div>
                </div>

                <section id="tabs" class="project-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <nav>
                                    <div class="nav nav-tabs nav-fill" data-toggle="tab" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-company-tab" data-toggle="tab" href="#nav-company" role="tab" aria-controls="nav-company" aria-selected="false">Company</a>
                                        <a class="nav-item nav-link" id="nav-estimates-tab" data-toggle="tab" href="#nav-estimates" role="tab" aria-controls="nav-estimates" aria-selected="false">Estimates</a>
                                        <a class="nav-item nav-link" id="nav-invoices-tab" data-toggle="tab" href="#nav-invoices" role="tab" aria-controls="nav-invoices" aria-selected="false">Invoices</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-company" role="tabpanel" aria-labelledby="nav-home-tab">
                                                <table class="w-100 border-bottom border-top">
                                                    <tr class="border-bottom text-white table-header" style="box-shadow: none !important; font-weight: normal">
                                                        <th>Name</th>
                                                        <th>logo</th>
                                                        <th>Email</th>
                                                        <th>Address</th>
                                                        <th>Phone</th>
                                                    </tr>
                                                    <tbody id="append_hook">
                                                    <tr class="border-bottom">
                                                        <td class="text-muted">{{$client->company->name}}</td>
                                                        <td class="pl-3">@if($client->company->logo != null)
                                                                <img src="{{asset('/images/'.$client->company->id.$client->company->logo.'')}}" class="user-profile-img rounded-circle" alt="{{asset('/images/blank_profile_picture.png')}}">
                                                            @else
                                                                <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
                                                            @endif</td>
                                                        <td class="text-muted">{{$client->company->email}}</td>
                                                        <td class="text-muted">{{$client->company->city}}, {{$client->company->zipcode}}</td>
                                                        <td class="text-muted">{{$client->company->phone}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane fade" id="nav-estimates" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                <table class="w-100 border-bottom border-top">
                                                    <tr class="border-bottom text-white table-header" style="box-shadow: none !important; font-weight: normal">
                                                        <th>Number</th>
                                                        <th>Title</th>
                                                        <th>Company</th>
                                                        <th>Client</th>
                                                        <th>Total</th>
                                                        <th>Sent Date</th>
                                                        <th>Due Date</th>
                                                        <th>Sign Date</th>
                                                        <th>Created At</th>
                                                        <th class="desktoptd">Actions</th>
                                                    </tr>
                                                    <tbody id="append_hook">
                                                    @php($clients = \App\Models\Client::all())
                                                    @include('estimates.scroll', ['estimates' => $client->Estimates])
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane fade" id="nav-invoices" role="tabpanel" aria-labelledby="nav-invoices-tab">

                                                <table class="w-100 border-bottom border-top">
                                                    <tr class="border-bottom text-white table-header" style="box-shadow: none !important; font-weight: normal">
                                                        <th>Number</th>
                                                        <th>Title</th>
                                                        <th>Company</th>
                                                        <th>Client</th>
                                                        <th>Total</th>
                                                        <th>Sent Date</th>
                                                        <th>Due Date</th>
                                                        <th>Pay Date</th>
                                                        <th>Created At</th>
                                                        <th class="desktoptd">Actions</th>
                                                    </tr>
                                                    <tbody id="append_hook">
                                                    @php($clients = \App\Models\Client::all())
                                                    @include('invoices.scroll', ['invoices' => $client->Invoices])
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


@stop
