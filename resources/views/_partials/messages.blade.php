@if(session()->has('success_message'))
    <div class="alert alert-success alert-dismissible show">Success: {{session('success_message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button></div>
    </div>
@endif

@if(count($errors) > 0)
<div class="alert alert-danger fade alert-dismissible show" role="alert">Error: {{$errors->first()}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button></div>
@endif
