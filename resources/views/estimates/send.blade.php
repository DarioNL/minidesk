<div id="sendModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Send Estimate @if($estimate->title != null){{$estimate->title}}@else{{$estimate->number}}@endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/company/estimates/{{$estimate->id}}/send">
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
                               name="color" value="#0000A0"
                               required autofocus>


                        @error('color')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
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
