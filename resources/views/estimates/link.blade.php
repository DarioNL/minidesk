<div id="linkModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Link Estimate @if($estimate->title != null){{$estimate->title}}@else{{$estimate->number}}@endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" @auth('web') action="/company/estimates/{{$estimate->id}}/link" @else action="/admin/estimates/{{$estimate->id}}/link" @endauth>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="client" class="font-weight-bolder text-muted col-form-label">{{__('Clients')}}</label>
                        @auth('web')
                        @php($clients = $estimate->company->clients)
                        @else
                            @php($clients = \App\Models\Client::all())
                        @endauth
                        @if(count($clients))
                            <select name="client" class="form-control">
                                @foreach($clients as $client)
                                    <option value="{{$client->id}}" title="">{{$client->first_name}} {{$client->last_name}}</option>
                                @endforeach
                            </select>
                        @else
                            <p class="text-muted">No users to link</p>
                        @endif


                        @error('send_date')
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
                @if(count($clients))
                    <button type="submit" class="btn btn-success">Link</button>
                @endif
            </div>
            </form>
        </div>
    </div>
</div>
