<div id="linkCompanyModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Link Invoice @if($estimate->title != null){{$estimate->title}}@else{{$estimate->number}}@endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/admin/estimates/{{$estimate->id}}/link/company" >
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="company" class="font-weight-bolder text-muted col-form-label">{{__('company')}}</label>
                        @php($companies = \App\Models\Company::all())
                        @if(count($companies))
                            <select name="company" class="form-control">
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}" title="">{{$company->name}}</option>
                                @endforeach
                            </select>
                        @else
                            <p class="text-muted">No companies to link</p>
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
