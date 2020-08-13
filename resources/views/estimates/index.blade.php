@extends('layouts.app')

@section('content')
    @auth('web')
@include('estimates.create', ['clients' => $clients])
    @endauth
    <div class="card table-container align-items-center w-100">
        <div class="w-100 border-bottom p-2">
        <div class="float-left">
        <h3 class="float-left pt-2">All Estimates</h3>
        </div>
            @auth('web')
        <div class="float-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                 + Create New Estimate
            </button>
        </div>
            @endauth
        </div>
        <div class="card-body w-100 pt-2">
            <div class="card-title mb-5 text-muted">
                <h4 class="float-right text-muted mr-2 mt-1 desktoptd">
                    <form method="get">
                        <i class="uil uil-search"></i>
                        <input type="text" class="searchinput searchitem" name="search" minlength="2" placeholder="Search">
                        <a href="/company/clients" class="text-muted text-decoration-none">x</a>
                    </form>
                </h4>
            </div>
            <div class="card-text">
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
                        @auth('web')
                        <th class="desktoptd">Actions
                        @endauth
                    </tr>
                    <tbody id="append_hook">
                    @include('estimates.scroll', ['estimates' => $estimates])
            </div>
        </div>
    </div>


@stop
