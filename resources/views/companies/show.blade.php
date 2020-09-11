@extends('layouts.app')

@section('content')

    @include('companies.delete', ['company' => $company])
    @include('companies.edit', ['company' => $company])

    <div class="card">
        <div class="card-body pt-2">
            <div class="card-title mb-5 text-muted">
                <h3 class="float-left">{{$company->name}}</h3>
            </div>
            <div class="card-text">
                <div class="row">
                    <div class="col-6">
                        <p class="text-muted font-weight-bolder">Name</p>
                        {{$company->name}}
                    </div>
                    <div class="col-6">
                        <p class="text-muted font-weight-bolder">Email</p>
                        {{$company->email}}
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-6">
                        <p class="text-muted font-weight-bolder">Address</p>
                        {{$company->address ?? '-'}}  {{$company->house_number}}{{$company->house_number_suffix}}
                    </div>
                    <div class="col-6">
                        <p class="text-muted font-weight-bolder">Zipcode</p>
                        {{$company->zipcode ?? '-'}}
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-6">
                        <p class="text-muted font-weight-bolder">Company</p>
                        @if($company->logo != null)
                            <img src="{{asset($company->logo)}}" class="company-profile-img" alt="user logo">
                        @else
                            <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
                        @endif
                    </div>
                    <div class="col-6">
                        <p class="text-muted font-weight-bolder">City</p>
                        {{$company->city ?? '-'}}
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-6">
                        <p class="text-muted font-weight-bolder">Phone</p>
                        {{$company->phone ?? '-'}}
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
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-estimates" role="tab" aria-controls="nav-estimates" aria-selected="false">Estimates</a>
                                        <a class="nav-item nav-link" id="nav-invoices-tab" data-toggle="tab" href="#nav-invoices" role="tab" aria-controls="nav-invoices" aria-selected="false">Invoices</a>
                                        <a class="nav-item nav-link" id="nav-clients-tab" data-toggle="tab" href="#nav-clients" role="tab" aria-controls="nav-clients" aria-selected="false">Clients</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-estimates" role="tabpanel" aria-labelledby="nav-home-tab">
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
                                                    @include('estimates.scroll', ['estimates' => $company->Estimates])
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
                                                    @include('invoices.scroll', ['invoices' => $company->Invoices])
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane fade" id="nav-clients" role="tabpanel" aria-labelledby="nav-clients-tab">

                                                <table class="w-100 border-bottom border-top">
                                                    <tr class="border-bottom text-white table-header" style="box-shadow: none !important; font-weight: normal">
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th class="desktoptd">Company Name</th>
                                                        <th>Email</th>
                                                        <th class="desktoptd">Address</th>
                                                        <th>Phone</th>
                                                        <th class="desktoptd">Created At</th>
                                                        <th class="desktoptd">Actions</th>
                                                    </tr>
                                                    @php($companies = \App\Models\Company::all())
                                                    <tbody id="append_hook">
                                                    @include('clients.scroll', ['clients' => $company->Clients, 'companies' => $companies])
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
