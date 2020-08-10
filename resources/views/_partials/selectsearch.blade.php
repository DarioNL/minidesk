<div class="form-group">
    <label for="{{$name}}">{{$title}}</label>
    <select name="{{$name}}" id="{{$name}}" @if(isset($data)) {{$data}} @endif class="select2 form-control"
            data-live-search="true">
        <option value="null">No data chosen</option>
        @foreach($options as $key => $text)
            <option @if($default === $key) selected @endif value="{{$key}}">{{ucfirst($text)}}</option>
        @endforeach
    </select>
</div>

@error($name)
<span class="invalid-feedback d-block" style="margin-top: -15px;" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
