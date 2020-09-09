<div id="sendModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Send invoice @if($invoice->title != null){{$invoice->title}}@else{{$invoice->number}}@endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" @auth('web') action="/company/invoices/{{$invoice->id}}/send" @else action="/admin/invoices/{{$invoice->id}}/send" @endauth>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <label for="send_date" class="font-weight-bolder text-muted col-form-label">{{__('Send Date')}}</label>
                        <input type="date" autocomplete="send_date"
                               class="form-control"
                               name="send_date" value="{{old('send_date')}}"
                               required autofocus>


                        @error('send_date')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="color" class="font-weight-bolder text-muted col-form-label">{{__('Color')}}</label>
                        <input type="color" autocomplete="color"
                               class="form-control"
                               name="color" value="{{old('color')}}"
                               required autofocus>


                        @error('color')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="mollie_key" class="font-weight-bolder text-muted col-form-label">{{__('Mollie Key')}}</label>
                        <input type="text" autocomplete="mollie_key"
                               class="form-control"
                               name="mollie_key" value="{{$invoice->company->mollie_key}}"
                               required autofocus>


                        @error('mollie_key')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="true" name="save_key" id="save_key">
                            <label class="form-check-label" for="save_key">
                                Save Mollie Key
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                    @csrf
                    <button type="submit" class="btn btn-success">Send</button>
            </div>
            </form>
        </div>
    </div>
</div>
