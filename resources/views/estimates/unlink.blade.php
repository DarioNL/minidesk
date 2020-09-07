<div id="unlinkModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Unlink Estimate @if($estimate->title != null){{$estimate->title}}@else{{$estimate->number}}@endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" @auth('web') action="/company/estimates/{{$estimate->id}}/unlink" @else action="/admin/estimates/{{$estimate->id}}/unlink" @endauth>
            <div class="modal-body">
                <p>Are you sure that you want to unlink client {{$estimate->client->first_name}} {{$estimate->client->last_name}}</p>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                    @csrf
                    <button type="submit" class="btn btn-danger">Unlink</button>
            </div>
            </form>
        </div>
    </div>
</div>
