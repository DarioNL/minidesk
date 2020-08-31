<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create New Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/company/clients/create">
            <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="first_name" class="font-weight-bolder text-muted col-form-label">{{__('First Name')}}</label>
                            <input type="text" autocomplete="first_name"
                                   class="form-control"
                                   name="first_name" value="{{old('first_name')}}"
                                   required autofocus>


                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="col-6">
                            <label for="last_name" class="font-weight-bolder text-muted col-form-label">{{__('Last Name')}}</label>
                            <input type="text" autocomplete="last_name"
                                   class="form-control"
                                   name="last_name" value="{{old('last_name')}}"
                                   required autofocus>


                            @error('last_name')
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
                                   name="house_number" value="{{old('house_number')}}"
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
                                   name="house_number_suffix" value="{{old('house_number_suffix')}}"
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
                                   name="city" value="{{old('city')}}"
                                   autofocus>


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
                                   name="zipcode" value="{{old('zipcode')}}"
                                   autofocus>


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
                                   name="address" value="{{old('address')}}"
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
                                   name="phone" value="{{old('phone')}}"
                                   autofocus>


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
                                   name="email" value="{{old('email')}}"
                                   autofocus>


                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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

