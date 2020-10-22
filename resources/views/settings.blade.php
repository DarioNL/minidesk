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
                    <div class="text-center p-3 dashboard-item">
                        @auth('web')
                            @if(Auth::user()->logo != null)
                                <img src="{{asset(Auth::user()->logo)}}" class="settings-company-logo cen"
                                     alt="user logo">
                            @else
                                <img src="{{asset('/images/blank_profile_picture.png')}}"
                                     class="settings-logo align-items-center ui-w-30 bg-white rounded-circle" alt="">
                                <h4 class="pt-3">{{$company->name}}</h4>
                                <h5 class="pt-3">{{$company->email}}</h5>
                                <form method="post" enctype="multipart/form-data" action="/settings/{{$company->id}}/logo/store">
                                    @csrf
                                    <div class="form-group">
                                        <input type="file" accept="image/*" class="" name="logo" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">Change Logo</button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        @elseauth('admins')
                            @if(Auth::user()->logo != null)
                                <img src="{{asset(Auth::user()->logo)}}" class="settings-company-logo cen"
                                     alt="user logo">
                            @else
                                <img src="{{asset('/images/blank_profile_picture.png')}}"
                                     class="settings-logo align-items-center ui-w-30 bg-white rounded-circle" alt="">
                            @endif
                            <h4 class="pt-3">{{$admin->first_name}} {{$admin->last_name}}</h4>
                            <h5 class="pt-3">{{$admin->email}}</h5>
                            <form method="post" enctype="multipart/form-data" action="/settings/{{$admin->id}}/logo/store">
                                @csrf
                                <div class="form-group">
                                    <input type="file" accept="image/*" class="" name="logo" required>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Change Logo</button>
                                    </div>
                                </div>
                            </form>
                        @else
                            @if(Auth::user()->logo != null)
                                <img src="{{asset(Auth::user()->logo)}}" class="settings-company-logo cen"
                                     alt="user logo">
                            @else
                                <img src="{{asset('/images/blank_profile_picture.png')}}"
                                     class="settings-logo align-items-center ui-w-30 bg-white rounded-circle" alt="">
                            @endif
                            <h4 class="pt-3">{{$client->first_name}} {{$client->last_name}}</h4>
                            <h5 class="pt-3">{{$client->email}}</h5>
                            <form method="post" enctype="multipart/form-data" action="/setting/{{$client->id}}/logo/store">
                                @csrf
                                <div class="form-group">
                                    <input type="file" accept="image/*" class="" name="logo" required>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Change Logo</button>
                                    </div>
                                </div>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-xs-12 card float-right">
                <div class="card-body">
                    <div class=" p-3 dashboard-item">
                        @auth('web')
                            <form action="settings/{{$company->id}}/store" method="post" class="form-horizontal form-material">
                                @csrf
                                <div class="form-group">
                                    <label for="first_name" class="col-md-12">Name</label>
                                    <div class="col-md-12">
                                        <input type="text" name="name" value="{{$company->name}}"
                                               class="form-control @error('name') is-invalid @enderror form-control-line" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" value="{{$company->email}}" class="form-control form-control-line"
                                               name="email" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="col-md-12">Address</label>
                                    <div class="col-md-12">
                                        <input type="text" value="{{$company->address}}" class="form-control form-control-line"
                                               name="address" required>
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="zipcode" class="col-md-12">Zipcode</label>
                                    <div class="col-md-12">
                                        <input type="text" value="{{$company->zipcode}}" class="form-control form-control-line"
                                               name="zipcode" required>
                                        @error('zipcode')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="city" class="col-md-12">City</label>
                                    <div class="col-md-12">
                                        <input type="text" value="{{$company->city}}" class="form-control form-control-line"
                                               name="city" required>
                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="house_number" class="col-md-12">House Number</label>
                                    <div class="col-md-12">
                                        <input type="text" value="{{$company->house_number}}" class="form-control form-control-line"
                                               name="house_number" required>
                                        @error('house_number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="house_number_suffix" class="col-md-12">House Number Suffix(optional)</label>
                                    <div class="col-md-12">
                                        <input type="text" value="{{$company->house_number_suffix}}" class="form-control form-control-line"
                                               name="house_number_suffix" required>
                                        @error('house_number_suffix')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="col-md-12">Phone</label>
                                    <div class="col-md-12">
                                        <input type="text" value="{{$company->phone}}" class="form-control form-control-line"
                                               name="phone" required>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="vat_number" class="col-md-12">Vat Number</label>
                                    <div class="col-md-12">
                                        <input type="text" value="{{$company->vat_number}}" class="form-control form-control-line"
                                               name="vat_number" required>
                                        @error('vat_number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-success">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                @elseauth('admins')
                    <form action="settings/{{$admin->id}}/store" method="post" class="form-horizontal form-material">
                        @csrf
                        <div class="form-group">
                            <label for="first_name" class="col-md-12">First Name</label>
                            <div class="col-md-12">
                                <input type="text" name="first_name" value="{{$admin->first_name}}"
                                       class="form-control @error('first_name') is-invalid @enderror form-control-line" required>
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="col-md-12">Last Name</label>
                            <div class="col-md-12">
                                <input type="text" name="last_name" value="{{$admin->last_name}}"
                                       class="form-control @error('last_name') is-invalid @enderror form-control-line" required>
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" value="{{$admin->email}}" class="form-control form-control-line"
                                       name="email" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success">Update Profile</button>
                            </div>
                        </div>
                    </form>
                @else
                    <form action="settings/{{$client->id}}/store" method="post" class="form-horizontal form-material">
                        @csrf
                        <div class="form-group">
                            <label for="first_name" class="col-md-12">First Name</label>
                            <div class="col-md-12">
                                <input type="text" name="first_name" value="{{$client->first_name}}"
                                       class="form-control @error('first_name') is-invalid @enderror form-control-line" required>
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="col-md-12">Last Name</label>
                            <div class="col-md-12">
                                <input type="text" name="last_name" value="{{$client->last_name}}"
                                       class="form-control @error('last_name') is-invalid @enderror form-control-line" required>
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" value="{{$client->email}}" class="form-control form-control-line"
                                       name="email" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-md-12">Address</label>
                            <div class="col-md-12">
                                <input type="text" value="{{$client->address}}" class="form-control form-control-line"
                                       name="address" required>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="zipcode" class="col-md-12">Zipcode</label>
                            <div class="col-md-12">
                                <input type="text" value="{{$client->zipcode}}" class="form-control form-control-line"
                                       name="zipcode" required>
                                @error('zipcode')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city" class="col-md-12">City</label>
                            <div class="col-md-12">
                                <input type="text" value="{{$client->city}}" class="form-control form-control-line"
                                       name="city" required>
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="house_number" class="col-md-12">House Number</label>
                            <div class="col-md-12">
                                <input type="text" value="{{$client->house_number}}" class="form-control form-control-line"
                                       name="house_number" required>
                                @error('house_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="house_number_suffix" class="col-md-12">House Number Suffix(optional)</label>
                            <div class="col-md-12">
                                <input type="text" value="{{$client->house_number_suffix}}" class="form-control form-control-line"
                                       name="house_number_suffix" required>
                                @error('house_number_suffix')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-md-12">Phone</label>
                            <div class="col-md-12">
                                <input type="text" value="{{$client->phone}}" class="form-control form-control-line"
                                       name="phone" required>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success">Update Profile</button>
                            </div>
                        </div>
                    </form>
                @endauth
            </div>
        </div>
    </div>
        <div class="row w-100 p-2">
            <div class="col-md-4 ml-1 float-left card col-xs-12">
                <div class="card-body user">
                    <div class="p-3 dashboard-item">
                        <form
                            action="settings/@auth('web'){{$company->id}}@elseauth('admins'){{$admin->id}}@else{{$client->id}}@endauth/change/password"
                            method="post" class="form-horizontal form-material">
                            @csrf
                            <div class="form-group">
                                <label for="password" class="col-md-12">New Password</label>
                                <div class="col-md-12">
                                    <input type="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror form-control-line" required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirm" class="col-md-12">Confirm New Password</label>
                                <div class="col-md-12">
                                    <input type="password" name="password_confirm"
                                           class="form-control @error('password_confirm') is-invalid @enderror form-control-line" required>
                                    @error('password_confirm')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
