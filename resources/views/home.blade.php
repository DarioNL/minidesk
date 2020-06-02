@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-text">
                    <div class="row m-0">
                        <div class="col-4 text-center p-2">
                            <h4 class="text-muted">Clients</h4>
                            <p class="text-muted">{{'1'}}</p>
                        </div>
                        <div class="col-4 text-center p-2">
                            <h4 class="text-muted">Estimates</h4>
                            <p class="text-muted">{{'1'}}</p>
                        </div>

                        <div class="col-4 text-center p-2">
                            <h4 class="text-muted">Invoices</h4>
                            <p class="text-muted">{{'1'}}</p>
                        </div>
                    </div>

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
