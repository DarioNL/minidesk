@extends('layouts.app')

@section('content')
@include('clients.create')
    <div class="card table-container align-items-center w-100">
        <div class="w-100 border-bottom p-2">
        <div class="float-left">
        <h3 class="float-left pt-2">All Clients</h3>
        </div>
        <div class="float-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                 + Create New Client
            </button>
        </div>
        </div>
        <div class="card-body w-100 pt-2">
            <div class="card-title mb-5 text-muted">
                <h4 class="float-right text-muted mr-2 mt-1 desktoptd">
                    <form action="/company/clients/search" method="POST" role="search">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="searchinput searchitem" name="q" placeholder="Search Clients"> <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <i class="uil uil-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </h4>
            </div>
            <div class="card-text">
                <table class="w-100 border-bottom border-top">
                    <tr class="border-bottom text-white table-header" style="box-shadow: none !important; font-weight: normal">
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th class="desktoptd">Company Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th class="desktoptd">Created At</th>
                    </tr>
                    <tbody id="append_hook">
                    @include('clients.scroll', ['clients' => $clients])
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@stop
