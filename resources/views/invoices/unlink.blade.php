<div id="unlinkModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Unlink Invoice @if($invoice->title != null){{$invoice->title}}@else{{$invoice->number}}@endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/company/invoices/{{$invoice->id}}/unlink">
            <div class="modal-body">
                <p>Are you sure that you want to unlink client {{$invoice->client->first_name}} {{$invoice->client->last_name}}</p>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                    @csrf
                    <button type="submit" class="btn btn-danger">Unlink</button>
            </div>
            </form>
        </div>
    </div>
</div>
