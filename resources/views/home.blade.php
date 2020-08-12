@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="mt-5">
            <div class="card">
                <div class="card-text">
                    <div class="row m-0">
                        <div class="col-4 text-center p-2">
                            <h4 class="text-muted">Clients</h4>
                            <p class="text-muted">{{count($clients)}}</p>
                        </div>
                        <div class="col-4 text-center p-2">
                            <h4 class="text-muted">Estimates</h4>
                            <p class="text-muted">{{count($estimates)}}</p>
                        </div>

                        <div class="col-4 text-center p-2">
                            <h4 class="text-muted">Invoices</h4>
                            <p class="text-muted">{{count($invoices)}}</p>
                        </div>
                    </div>

                    <section id="tabs" class="project-tab w-100">
                        <div class="container">
                            <div class="row">
                                <div class="">
                                    <nav>
                                        <div class="nav nav-tabs nav-fill" data-toggle="tab" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="nav-company-tab" data-toggle="tab" href="#nav-company" role="tab" aria-controls="nav-company" aria-selected="false">Company</a>
                                            <a class="nav-item nav-link" id="nav-estimates-tab" data-toggle="tab" href="#nav-estimates" role="tab" aria-controls="nav-estimates" aria-selected="false">Estimates</a>
                                            <a class="nav-item nav-link" id="nav-invoices-tab" data-toggle="tab" href="#nav-invoices" role="tab" aria-controls="nav-invoices" aria-selected="false">Invoices</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane home-tab fade show active text-center" id="nav-company" role="tabpanel" aria-labelledby="nav-home-tab">
                                                <table class="w-100 border-bottom border-top">
                                                    <tr class="border-bottom text-white table-header" style="box-shadow: none !important; font-weight: normal">
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Company Name</th>
                                                        <th>Email</th>
                                                        <th>Address</th>
                                                        <th>Phone</th>
                                                        <th>Created At</th>
                                                        <th class="desktoptd">Actions</th>
                                                    </tr>
                                                    <tbody id="append_hook">
                                                    @include('clients.scroll', ['clients' => $clients])
                                                    </tbody>
                                                </table>
                                                <a href="/company/clients" class="text-center">Show All Clients</a>
                                            </div>
                                            <div class="tab-pane home-tab fade text-center" id="nav-estimates" role="tabpanel" aria-labelledby="nav-profile-tab">
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
                                                    @include('estimates.scroll', ['estimates' => $estimates])
                                                    <a href="/company/clients" class="text-center">Show All Estimates</a>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane home-tab fade text-center" id="nav-invoices" role="tabpanel" aria-labelledby="nav-invoices-tab">

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
                                                    @include('invoices.scroll', ['invoices' => $invoices])
                                                    <a href="/company/clients" class="text-center">Show All Invoices</a>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
