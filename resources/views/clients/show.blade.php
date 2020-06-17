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



@stop
