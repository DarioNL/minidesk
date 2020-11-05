@extends('layouts.app')

@section('content')
    <div class="card table-container align-items-center w-100 text-center">
        <h1 class="title">Invoice @if($invoice->title != null){{$invoice->title}}@else{{$invoice->number}}@endif has been paid Thank You!</h1>
        <p class="lead"><strong>Please check your email</strong> for your receipt.</p>
        <hr>
        <div class="border-top w-100">
            <p class="lead pt-3">
                <a class="btn btn-primary" href="/dashboard" role="button">Continue to dashboard</a>
            </p>
        </div>
    </div>
@stop
