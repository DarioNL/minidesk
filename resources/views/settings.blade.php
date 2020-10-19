@extends('layouts.app')

@section('content')

    <div class="card table-container align-items-center w-100">
        <div class="w-100 border-bottom p-2">
            <div class="float-left">
                <h3 class="float-left pt-2">Settings</h3>
            </div>
            <div class="float-right">
                <a href="/dashboard" class="h3 text-muted float-left pt-2">back</a>
            </div>
        </div>
        <div class="row w-100">
            <div class="col-md-4 float-left card col-xs-12">
                <div class="card-body user">
                        <div class="text-center dashboard-item">
                            @auth('web')
                            @if(Auth::user()->logo != null)
                                <img src="{{asset(Auth::user()->logo)}}" class="settings-company-logo cen" alt="user logo">
                            @else
                                <img src="{{asset('/images/blank_profile_picture.png')}}" class="settings-logo align-items-center ui-w-30 bg-white rounded-circle" alt="">
                                    <h4 class="pt-3">{{$company->name}}</h4>
                                    <h5 class="pt-3">{{$company->email}}</h5>
                            @endif
                            @elseauth('admins')
                                @if(Auth::user()->logo != null)
                                    <img src="{{asset(Auth::user()->logo)}}" class="settings-company-logo cen" alt="user logo">
                                @else
                                    <img src="{{asset('/images/blank_profile_picture.png')}}" class="settings-logo align-items-center ui-w-30 bg-white rounded-circle" alt="">
                                @endif
                                    <h4 class="pt-3">{{$admin->first_name}} {{$admin->last_name}}</h4>
                                    <h5 class="pt-3">{{$admin->email}}</h5>
                            @else
                                @if(Auth::user()->logo != null)
                                    <img src="{{asset(Auth::user()->logo)}}" class="settings-company-logo cen" alt="user logo">
                                @else
                                    <img src="{{asset('/images/blank_profile_picture.png')}}" class="settings-logo align-items-center ui-w-30 bg-white rounded-circle" alt="">
                                @endif
                                    <h4 class="pt-3">{{$client->first_name}} {{$client->last_name}}</h4>
                                    <h5 class="pt-3">{{$client->email}}</h5>
                            @endauth
                        </div>
                </div>
            </div>
            <div class="col-md-8 col-xs-12 float-right">
                <div class="dashboard-item">
                    <form class="form-horizontal form-material">
                        <div class="form-group">
                            <label class="col-md-12">Full Name</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line"> </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Password</label>
                            <div class="col-md-12">
                                <input type="password" value="password" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Phone No</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="123 456 7890" class="form-control form-control-line"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Message</label>
                            <div class="col-md-12">
                                <textarea rows="5" class="form-control form-control-line"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12">Select Country</label>
                            <div class="col-sm-12">
                                <select class="form-control form-control-line">
                                    <option>London</option>
                                    <option>India</option>
                                    <option>Usa</option>
                                    <option>Canada</option>
                                    <option>Thailand</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
