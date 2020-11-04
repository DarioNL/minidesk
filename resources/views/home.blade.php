@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="mt-5">
            <div class="card">
                <div class="card-text">
                    <div class="row m-0 ">
                        @auth('web')

                            <div class="col-md-4 text-center p-2 col-sm-12">
                                <div class="card dashboard-item">
                                <div class="dashboard-content">
                                    <div class="float-left">
                                        <i class="dashboard-icons fas fa-user"></i>
                                    </div>
                                    <div class="float-right" style="margin-left: 100px">
                                        <div class="stat-text"><h4 class="count">{{count($clients)}}</h4></div>
                                        <div class="stat-heading"><h6>Total Clients</h6> </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="col-md-4 text-center p-2 col-sm-12">
                                <div class="card dashboard-item">
                                <div class="dashboard-content">
                                    <div class="float-left">
                                        <i class="dashboard-icons fas fa-file-signature"></i>
                                    </div>
                                    <div class="float-right" style="margin-left: 100px">
                                        <div class="stat-text"><h4 class="count">{{count($estimates)}}</h4></div>
                                        <div class="stat-heading"><h6>Total Estimates</h6> </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="col-md-4 text-center p-2 col-sm-12">
                                <div class="card dashboard-item">
                                <div class="dashboard-content">
                                    <div class="float-left">
                                        <i class="fas fa-file-invoice dashboard-icons"></i>
                                    </div>
                                    <div class="float-right" style="margin-left: 100px">
                                        <div class="stat-text"><h4 class="count">{{count($invoices)}}</h4></div>
                                        <div class="stat-heading"><h6>Total Invoices</h6> </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                        @elseauth('admins')
                            <div class="col-md-3 text-center p-2 col-sm-12">
                                <div class="card dashboard-item">
                                    <div class="dashboard-content">
                                        <div class="float-left">
                                            <i class="fas fa-building dashboard-icons"></i>
                                        </div>
                                        <div class="float-right" style="margin-left: 100px">
                                            <div class="stat-text"><h4 class="count">{{count($companies)}}</h4></div>
                                            <div class="stat-heading"><h6>Total Companies</h6> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 text-center p-2 col-sm-12">
                                <div class="card dashboard-item">
                                    <div class="dashboard-content">
                                        <div class="float-left">
                                            <i class="dashboard-icons fas fa-user"></i>
                                        </div>
                                        <div class="float-right" style="margin-left: 100px">
                                            <div class="stat-text"><h4 class="count">{{count($clients)}}</h4></div>
                                            <div class="stat-heading"><h6>Total Clients</h6> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 text-center p-2 col-sm-12">
                                <div class="card dashboard-item">
                                    <div class="dashboard-content">
                                        <div class="float-left">
                                            <i class="dashboard-icons fas fa-file-signature"></i>
                                        </div>
                                        <div class="float-right" style="margin-left: 100px">
                                            <div class="stat-text"><h4 class="count">{{count($estimates)}}</h4></div>
                                            <div class="stat-heading"><h6>Total Estimates</h6> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 text-center p-2 col-sm-12">
                                <div class="card dashboard-item">
                                    <div class="dashboard-content">
                                        <div class="float-left">
                                            <i class="fas fa-file-invoice dashboard-icons"></i>
                                        </div>
                                        <div class="float-right" style="margin-left: 100px">
                                            <div class="stat-text"><h4 class="count">{{count($invoices)}}</h4></div>
                                            <div class="stat-heading"><h6>Total Invoices</h6> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-md-6 text-center p-2 col-sm-12">
                                <div class="card dashboard-item">
                                    <div class="dashboard-content">
                                        <div class="float-left">
                                            <i class="dashboard-icons fas fa-file-signature"></i>
                                        </div>
                                        <div class="float-right" style="margin-left: 100px">
                                            <div class="stat-text"><h4 class="count">{{count($estimates)}}</h4></div>
                                            <div class="stat-heading"><h6>Total Estimates</h6> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 text-center p-2 col-sm-12">
                                <div class="card dashboard-item">
                                    <div class="dashboard-content">
                                        <div class="float-left">
                                            <i class="fas fa-file-invoice dashboard-icons"></i>
                                        </div>
                                        <div class="float-right" style="margin-left: 100px">
                                            <div class="stat-text"><h4 class="count">{{count($invoices)}}</h4></div>
                                            <div class="stat-heading"><h6>Total Invoices</h6> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endauth
                    </div>

{{--                    <section id="tabs" class="project-tab w-75">--}}
{{--                        <div class="container">--}}
{{--                            <div class="row">--}}
{{--                                <div class="">--}}
{{--                                    <nav>--}}
{{--                                        <div class="nav nav-tabs nav-fill" data-toggle="tab" id="nav-tab" role="tablist">--}}
{{--                                            <a class="nav-item nav-link active" id="nav-company-tab" data-toggle="tab" href="#nav-company" role="tab" aria-controls="nav-company" aria-selected="false">@auth('web')Clients @else Company @endauth</a>--}}
{{--                                            <a class="nav-item nav-link" id="nav-estimates-tab" data-toggle="tab" href="#nav-estimates" role="tab" aria-controls="nav-estimates" aria-selected="false">Estimates</a>--}}
{{--                                            <a class="nav-item nav-link" id="nav-invoices-tab" data-toggle="tab" href="#nav-invoices" role="tab" aria-controls="nav-invoices" aria-selected="false">Invoices</a>--}}
{{--                                        </div>--}}
{{--                                    </nav>--}}
{{--                                    <div class="tab-content" id="nav-tabContent">--}}
{{--                                        <div class="tab-content" id="nav-tabContent">--}}
{{--                                            <div class="tab-pane home-tab fade show active text-center" id="nav-company" role="tabpanel" aria-labelledby="nav-home-tab">--}}
{{--                                                <table class="table-fullscreen--}}
{{--                                                 border-bottom border-top">--}}
{{--                                                    <tr class="border-bottom text-white table-header" style="box-shadow: none !important; font-weight: normal">--}}
{{--                                                            @auth('web')--}}
{{--                                                                <th>First Name</th>--}}
{{--                                                                <th>Last Name</th>--}}
{{--                                                                <th class="desktoptd">Company Name</th>--}}
{{--                                                                <th>Email</th>--}}
{{--                                                                <th class="desktoptd">Address</th>--}}
{{--                                                                <th>Phone</th>--}}
{{--                                                                <th class="desktoptd">Created At</th>--}}
{{--                                                                <th class="desktoptd">Actions</th>--}}
{{--                                                            @else--}}
{{--                                                                <th>Name</th>--}}
{{--                                                                <th>Logo</th>--}}
{{--                                                                <th>Email</th>--}}
{{--                                                                <th>Address</th>--}}
{{--                                                                <th>Phone</th>--}}
{{--                                                            @endauth--}}
{{--                                                    </tr>--}}
{{--                                                    <tbody id="append_hook">--}}
{{--                                                    @auth('web')--}}
{{--                                                    @include('clients.scroll', ['clients' => $clients])--}}
{{--                                                    @else--}}
{{--                                                        <tr class="border-bottom">--}}
{{--                                                            <td class="text-muted">{{$client->company->name}}</td>--}}
{{--                                                            <td class="pl-3">@if($client->company->logo != null)--}}
{{--                                                                    <img src="{{asset($client->company->logo)}}" class="company-profile-img" alt="user logo">--}}
{{--                                                                @else--}}
{{--                                                                    <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">--}}
{{--                                                                @endif{{$client->company->name}}</td>--}}
{{--                                                            <td class="text-muted">{{$client->company->email}}</td>--}}
{{--                                                            <td class="text-muted">{{$client->company->city}}, {{$client->company->zipcode}}</td>--}}
{{--                                                            <td class="text-muted">{{$client->company->phone}}</td>--}}
{{--                                                        </tr>--}}
{{--                                                    @endauth--}}
{{--                                                    </tbody>--}}
{{--                                                </table>--}}
{{--                                                @auth('web')--}}
{{--                                                    <a href="/company/clients" class="text-center">Show All Clients</a>--}}
{{--                                                @endauth--}}
{{--                                            </div>--}}
{{--                                            <div class="tab-pane home-tab fade text-center" id="nav-estimates" role="tabpanel" aria-labelledby="nav-profile-tab">--}}
{{--                                                <table class="w-100 border-bottom border-top">--}}
{{--                                                    <tr class="border-bottom text-white table-header" style="box-shadow: none !important; font-weight: normal">--}}
{{--                                                        <th class="desktoptd">Number</th>--}}
{{--                                                        <th>Title</th>--}}
{{--                                                        <th class="desktoptd">Company</th>--}}
{{--                                                        <th>Client</th>--}}
{{--                                                        <th>Total</th>--}}
{{--                                                        <th class="desktoptd">Sent Date</th>--}}
{{--                                                        <th class="desktoptd">Due Date</th>--}}
{{--                                                        <th>Sign Date</th>--}}
{{--                                                        <th class="desktoptd">Created At</th>--}}
{{--                                                        <th class="desktoptd">Actions</th>--}}
{{--                                                    </tr>--}}
{{--                                                    <tbody id="append_hook">--}}
{{--                                                    @include('estimates.scroll', ['estimates' => $estimates])--}}
{{--                                                    </tbody>--}}
{{--                                                </table>--}}
{{--                                                @auth('web')--}}
{{--                                                    <a href="/company/estimates" class="text-center">Show All Estimates</a>--}}
{{--                                                @else--}}
{{--                                                    <a href="/client/estimates" class="text-center">Show All Estimates</a>--}}
{{--                                                @endauth--}}
{{--                                            </div>--}}
{{--                                            <div class="tab-pane home-tab fade text-center" id="nav-invoices" role="tabpanel" aria-labelledby="nav-invoices-tab">--}}

{{--                                                <table class="w-100 border-bottom border-top">--}}
{{--                                                    <tr class="border-bottom text-white table-header" style="box-shadow: none !important; font-weight: normal">--}}
{{--                                                        <th class="desktoptd">Number</th>--}}
{{--                                                        <th>Title</th>--}}
{{--                                                        <th class="desktoptd">Company</th>--}}
{{--                                                        <th>Client</th>--}}
{{--                                                        <th>Total</th>--}}
{{--                                                        <th class="desktoptd">Sent Date</th>--}}
{{--                                                        <th class="desktoptd">Due Date</th>--}}
{{--                                                        <th>Pay Date</th>--}}
{{--                                                        <th class="desktoptd">Created At</th>--}}
{{--                                                        <th class="desktoptd">Actions</th>--}}
{{--                                                    </tr>--}}
{{--                                                    <tbody id="append_hook">--}}
{{--                                                    @include('invoices.scroll', ['invoices' => $invoices])--}}
{{--                                                    </tbody>--}}
{{--                                                </table>--}}
{{--                                                @auth('web')--}}
{{--                                                    <a href="/company/invoices" class="text-center">Show All Invoices</a>--}}
{{--                                                @else--}}
{{--                                                    <a href="/client/invoices" class="text-center">Show All Invoices</a>--}}
{{--                                                @endauth--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </section>--}}
                    <div class="row">
                        <div class="card col-md-6 col-sm-12">
                            <div class="card-header">Recent activities</div>

                            <div class="card-body dashboard-item">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="">
                                    <div class="row p-b-30">
                                        <div class="col-auto text-right update-meta p-r-0">
                                            @if(Auth::user()->logo != null)
                                                <img src="{{asset(Auth::user()->logo)}}" class="company-profile-img" alt="user logo">
                                            @else
                                                <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
                                            @endif

                                        </div>
                                        <div class="col p-l-5">
                                            <a><h6>You are logged in!</h6></a>
                                            <p class="text-muted m-b-0">@if(Auth::user()->name){{Auth::user()->name}}@else {{Auth::user()->first_name}} {{Auth::user()->last_name}} @endif</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card col-md-6 col-sm-12">
                            <div class="card-header">Stats</div>

                            <div class="card-body dashboard-item">
                                <div class="progress-box progress-1">
                                    <h4 class="por-title">Accepted Estimates</h4>
                                    <div class="por-txt">{{count($acceptedEstimates)}}/{{count($estimates)}} Estimates ({{$estimatesPercent}}%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-1" role="progressbar" style="width: {{$estimatesPercent}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="progress-box progress-2">
                                    <h4 class="por-title">Accepted Invoices</h4>
                                    <div class="por-txt">{{count($acceptedInvoices)}}/{{count($invoices)}} Invoices ({{$invoicesPercent}}%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-2" role="progressbar" style="width: {{$invoicesPercent}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                @auth('admins')
                                <div class="progress-box progress-2">
                                    <h4 class="por-title">Verified Companies</h4>
                                    <div class="por-txt">{{count($verifiedCompanies)}}/{{count($companies)}} Users ({{$companiesPercent}}%)</div>
                                    <div class="progress mb-2" style="height: 5px;">
                                        <div class="progress-bar bg-flat-color-3" role="progressbar" style="width: {{$companiesPercent}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                    <section id="tabs" class="project-tab w-75">
                        <div class="container">
                            <div class="row">
                                <div class="">
                                    <nav class="dashboard-item">
                                        <div class="nav nav-tabs nav-fill" data-toggle="tab" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-client-tab" data-toggle="tab" href="#nav-client" role="tab" aria-controls="nav-client" aria-selected="false">@auth('web')Clients @elseauth('admins') Clients @else Company @endauth</a>
                                            @auth('admins')
                                                <a class="nav-item nav-link" id="nav-companies-tab" data-toggle="tab" href="#nav-companies" role="tab" aria-controls="nav-companies" aria-selected="false">Companies</a>
                                            @endauth
                                            <a class="nav-item nav-link" id="nav-estimates-tab" data-toggle="tab" href="#nav-estimates" role="tab" aria-controls="nav-estimates" aria-selected="false">Estimates</a>
                                            <a class="nav-item nav-link" id="nav-invoices-tab" data-toggle="tab" href="#nav-invoices" role="tab" aria-controls="nav-invoices" aria-selected="false">Invoices</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content dashboard-item" id="nav-tabContent">
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane home-tab fade show active text-center" id="nav-client" role="tabpanel" aria-labelledby="nav-home-tab">
                                                <table class="table-fullscreen
                                                                    border-bottom border-top">
                                                    <tr class="border-bottom text-white table-header" style="box-shadow: none !important; font-weight: normal">
                                                        @auth('web')
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th class="desktoptd">Company Name</th>
                                                            <th>Email</th>
                                                            <th class="desktoptd">Address</th>
                                                            <th>Phone</th>
                                                            <th class="desktoptd">Created At</th>
                                                            <th class="desktoptd">Actions</th>
                                                        @elseauth('admins')
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th class="desktoptd">Company Name</th>
                                                            <th>Email</th>
                                                            <th class="desktoptd">Address</th>
                                                            <th>Phone</th>
                                                            <th class="desktoptd">Created At</th>
                                                            <th class="desktoptd">Actions</th>
                                                        @else
                                                            <th>Name</th>
                                                            <th>Logo</th>
                                                            <th>Email</th>
                                                            <th>Address</th>
                                                            <th>Phone</th>
                                                        @endauth
                                                    </tr>
                                                    <tbody id="append_hook">
                                                    @auth('web')
                                                        @include('clients.scroll', ['clients' => $clients])
                                                    @elseauth('admins')
                                                        @include('clients.scroll', ['clients' => $clients])
                                                    @else
                                                        <tr class="border-bottom">
                                                            <td class="text-muted">{{$client->company->name}}</td>
                                                            <td class="pl-3">@if($client->company->logo != null)
                                                                    <img src="{{asset($client->company->logo)}}" class="company-profile-img" alt="user logo">
                                                                @else
                                                                    <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
                                                                @endif{{$client->company->name}}</td>
                                                            <td class="text-muted">{{$client->company->email}}</td>
                                                            <td class="text-muted">{{$client->company->city}}, {{$client->company->zipcode}}</td>
                                                            <td class="text-muted">{{$client->company->phone}}</td>
                                                        </tr>
                                                    @endauth
                                                    </tbody>
                                                </table>
                                                @auth('web')
                                                    <a href="/company/clients" class="text-center">Show All Clients</a>
                                                @elseauth('admins')
                                                    <a href="/admin/clients" class="text-center">Show All Clients</a>
                                                @endauth
                                            </div>
                                            @auth('admins')
                                                <div class="tab-pane home-tab fade text-center" id="nav-companies" role="tabpanel" aria-labelledby="nav-companies-tab">
                                                    <table class="w-100 border-bottom border-top">
                                                        <tr class="border-bottom text-white table-header" style="box-shadow: none !important; font-weight: normal">
                                                            <th>Name</th>
                                                            <th>Logo</th>
                                                            <th>Email</th>
                                                            <th>Address</th>
                                                            <th>Phone</th>
                                                            <th>Created At</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        <tbody id="append_hook">
                                                        @include('companies.scroll', ['companies' => $companies])
                                                        </tbody>
                                                    </table>
                                                    <a href="/admin/companies" class="text-center">Show All Companies</a>
                                                </div>
                                            @endauth
                                            <div class="tab-pane home-tab fade text-center" id="nav-estimates" role="tabpanel" aria-labelledby="nav-estimates-tab">
                                                <table class="w-100 border-bottom border-top">
                                                    <tr class="border-bottom text-white table-header" style="box-shadow: none !important; font-weight: normal">
                                                        <th class="desktoptd">Number</th>
                                                        <th>Title</th>
                                                        <th class="desktoptd">Company</th>
                                                        <th>Client</th>
                                                        <th>Total</th>
                                                        <th class="desktoptd">Sent Date</th>
                                                        <th class="desktoptd">Due Date</th>
                                                        <th>Sign Date</th>
                                                        <th class="desktoptd">Created At</th>
                                                        <th class="desktoptd">Actions</th>
                                                    </tr>
                                                    <tbody id="append_hook">
                                                    @include('estimates.scroll', ['estimates' => $estimates])
                                                    </tbody>
                                                </table>
                                                @auth('web')
                                                    <a href="/company/estimates" class="text-center">Show All Estimates</a>
                                                @elseauth('admins')
                                                    <a href="/admin/estimates" class="text-center">Show All Estimates</a>
                                                @else
                                                    <a href="/client/estimates" class="text-center">Show All Estimates</a>
                                                @endauth
                                            </div>
                                            <div class="tab-pane home-tab fade text-center" id="nav-invoices" role="tabpanel" aria-labelledby="nav-invoices-tab">
                                                <table class="w-100 border-bottom border-top">
                                                    <tr class="border-bottom text-white table-header" style="box-shadow: none !important; font-weight: normal">
                                                        <th class="desktoptd">Number</th>
                                                        <th>Title</th>
                                                        <th class="desktoptd">Company</th>
                                                        <th>Client</th>
                                                        <th>Total</th>
                                                        <th class="desktoptd">Sent Date</th>
                                                        <th class="desktoptd">Due Date</th>
                                                        <th>Pay Date</th>
                                                        <th class="desktoptd">Created At</th>
                                                        <th class="desktoptd">Actions</th>
                                                    </tr>
                                                    <tbody id="append_hook">
                                                    @include('invoices.scroll', ['invoices' => $invoices])
                                                    </tbody>
                                                </table>
                                                @auth('web')
                                                    <a href="/company/invoices" class="text-center">Show All Invoices</a>
                                                @elseauth('admins')
                                                    <a href="/admin/invoices" class="text-center">Show All Invoices</a>
                                                @else
                                                    <a href="/client/invoices" class="text-center">Show All Invoices</a>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
        </div>
    </div>
</div>
@endsection
