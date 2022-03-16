<div class="modal fade bd-example-modal-lg" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create New Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <form method="POST" @auth('admins') action="/admin/clients/create" @else action="/company/clients/create" @endauth>
            <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="first_name" class="font-weight-bolder text-muted col-form-label">{{__('First Name')}}</label>
                            <input type="text" autocomplete="first_name"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   name="first_name" value="{{old('first_name')}}"
                                   required autofocus>


                            @error('first_name')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="last_name" class="font-weight-bolder text-muted col-form-label">{{__('Last Name')}}</label>
                            <input type="text" autocomplete="last_name"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   name="last_name" value="{{old('last_name')}}"
                                   required autofocus>


                            @error('last_name')
                            <span class="invalid-feedback d-block" role="alert">
                                        <h3><strong>{{ $message }}</strong></h3>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label for="house_number" class="font-weight-bolder text-muted col-form-label">{{__('House Number')}}</label>
                            <input type="text" autocomplete="house_number"
                                   class="form-control @error('house_number') is-invalid @enderror"
                                   name="house_number" value="{{old('house_number')}}"
                                   required autofocus>


                            @error('house_number')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="house_number_suffix" class="font-weight-bolder text-muted col-form-label">{{__('Suffix (optional)')}}</label>
                            <input type="text" autocomplete="house_number_suffix"
                                   class="form-control @error('house_number_suffix') is-invalid @enderror"
                                   name="house_number_suffix" value="{{old('house_number_suffix')}}"
                                    autofocus>


                            @error('house_number_suffix')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-6">
                            <label for="city" class="font-weight-bolder text-muted col-form-label">{{__('City')}}</label>
                            <input type="text" autocomplete="city"
                                   class="form-control @error('city') is-invalid @enderror"
                                   name="city" value="{{old('city')}}"
                                   autofocus required>


                            @error('city')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="col-6">
                            <label for="zipcode" class="font-weight-bolder text-muted col-form-label">{{__('Zipcode')}}</label>
                            <input type="text" autocomplete="zipcode"
                                   class="form-control @error('zipcode') is-invalid @enderror"
                                   name="zipcode" value="{{old('zipcode')}}"
                                   autofocus required>


                            @error('zipcode')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-6">
                            <label for="address" class="font-weight-bolder text-muted col-form-label">{{__('Address')}}</label>
                            <input type="text" autocomplete="last_name"
                                   class="form-control @error('address') is-invalid @enderror"
                                   name="address" value="{{old('address')}}"
                                   required autofocus>


                            @error('address')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="phone" class="font-weight-bolder text-muted col-form-label">{{__('Phone')}}</label>
                            <input type="tel" autocomplete="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   name="phone" value="{{old('phone')}}"
                                   autofocus required>


                            @error('phone')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                <div class="row">
                        <div class="col-6">
                            <label for="email" class="font-weight-bolder text-muted col-form-label">{{__('Email')}}</label>
                            <input type="email" autocomplete="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{old('email')}}"
                                   autofocus required>


                            @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                 <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    @auth('admins')
                        <div class="col-6">
                            <label for="company" class="font-weight-bolder text-muted col-form-label">{{__('Company')}}</label>
                            @if(count($companies))
                                <select name="company" class="form-control">
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}" title="">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            @else
                                <p class="text-muted">No companies to link</p>
                            @endif
                            <a class="float-right" href="/admin/companies">Create new company</a>
                        </div>
                    @endauth


                </div>
                <div class="col-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" name="send_login" id="send_login">
                        <label class="form-check-label" for="send_login">
                            Send Login Info
                        </label>
                    </div>
                </div>

            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary float-right w-25">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

