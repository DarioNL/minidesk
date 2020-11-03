@if(session('success_msg'))
    <div class="d-none  alert alert-fixed alert-success">{{session('success_msg')}}</div>
@endif

@error('error_msg')
<div class="d-none  alert alert-fixed alert-danger">{{$message}}</div>
@enderror
