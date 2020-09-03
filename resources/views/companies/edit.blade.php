<div id="editModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data" action="/admin/companies/{{$company->id}}/edit">
            <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="name" class="font-weight-bolder text-muted col-form-label">{{__('Name')}}</label>
                                <input type="text" autocomplete="name"
                                       class="form-control"
                                       name="name" value="{{$company->name}}"
                                       required autofocus>


                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="logo" class="font-weight-bolder text-muted col-form-label">{{ __('Logo') }}</label>

                                <input id="logo" type="file" accept="image/*" class="form-control-file" name="logo">

                                @error('logo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label for="house_number" class="font-weight-bolder text-muted col-form-label">{{__('House Number')}}</label>
                                <input type="text" autocomplete="house_number"
                                       class="form-control"
                                       name="house_number" value="{{$company->house_number}}"
                                       required autofocus>


                                @error('house_number')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="house_number_suffix" class="font-weight-bolder text-muted col-form-label">{{__('Suffix (optional)')}}</label>
                                <input type="text" autocomplete="house_number_suffix"
                                       class="form-control"
                                       name="house_number_suffix" value="{{$company->house_number_suffix}}"
                                       autofocus>


                                @error('house_number_suffix')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-6">
                                <label for="city" class="font-weight-bolder text-muted col-form-label">{{__('City')}}</label>
                                <input type="text" autocomplete="city"
                                       class="form-control"
                                       name="city" value="{{$company->city}}"
                                       autofocus required>


                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>


                            <div class="col-6">
                                <label for="zipcode" class="font-weight-bolder text-muted col-form-label">{{__('Zipcode')}}</label>
                                <input type="text" autocomplete="zipcode"
                                       class="form-control"
                                       name="zipcode" value="{{$company->zipcode}}"
                                       autofocus required>


                                @error('zipcode')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-6">
                                <label for="address" class="font-weight-bolder text-muted col-form-label">{{__('Address')}}</label>
                                <input type="text" autocomplete="last_name"
                                       class="form-control"
                                       name="address" value="{{$company->address}}"
                                       required autofocus>


                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label for="phone" class="font-weight-bolder text-muted col-form-label">{{__('Phone')}}</label>
                                <input type="tel" autocomplete="phone"
                                       class="form-control"
                                       name="phone" value="{{$company->phone}}"
                                       autofocus required>


                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label for="email" class="font-weight-bolder text-muted col-form-label">{{__('Email')}}</label>
                                <input type="email" autocomplete="email"
                                       class="form-control"
                                       name="email" value="{{$company->email}}"
                                       autofocus required>


                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label for="mollie_key" class="font-weight-bolder text-muted col-form-label">{{__('Mollie Key (optional)')}}</label>
                                <input type="text" autocomplete="mollie_key"
                                       class="form-control"
                                       name="mollie_key" value="{{$company->mollie_key}}"
                                       autofocus>


                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="row col-12">
                                <div class="col-6">
                                    <label for="vat_number" class="font-weight-bolder text-muted col-form-label">{{ __('Vat Number') }}</label>
                                    <input id="vat_number" type="text" class="form-control" maxlength="9" name="vat_number" value="{{ $company->vat_number }}" required autofocus autocomplete="vat_number">

                                    @error('vat_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

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

