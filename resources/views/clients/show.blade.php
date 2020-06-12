@extends('layouts.app')

@section('content')

    <div class="card table-container align-items-center w-100">
        <div class="w-100 border-bottom p-2">
        <div class="float-left">
        <h3 class="float-left pt-2">All Clients</h3>
        </div>
        <div class="float-right">
            <a class="btn btn-primary w-25 desktoptd" href="/clients/create" style="color: white"> + Create new Client </a>
        </div>
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
                <table class="w-100">
                    <tr style="box-shadow: none !important;">
                        <th>first name</th>
                        <th>last name</th>
                        <th>company name</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>created at</th>
                        <th class="desktoptd">ACTIONS</th>
                    </tr>
                    <tbody id="append_hook">
                    @include('clients.scroll', ['clients' => $clients])
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@stop
