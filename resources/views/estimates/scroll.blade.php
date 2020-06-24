@if(count($estimates))
@foreach($estimates as $estimate)

    @include('estimates.delete', ['client' => $estimate])
    @include('estimates.edit', ['client' => $estimate])
    <tr class="clickable-row border-bottom" data-href="/clients/{{$estimate->id}}">
        <td class="pl-3">{{$estimate->number}}</td>
        <td class="pl-3">@if($estimates->company->logo != null)
                <img src="{{asset('/images/'.$estimates->company->id.$estimates->company->logo.'')}}" class="user-profile-img rounded-circle" alt="{{asset('/images/blank_profile_picture.png')}}">
            @else
                <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
            @endif{{$estimates->company->name}}</td>
        <td class="pl-3">@if($estimates->client->logo != null)
                <img src="{{asset('/images/'.$estimates->client->id.$estimates->client->logo.'')}}" class="user-profile-img rounded-circle" alt="{{asset('/images/blank_profile_picture.png')}}">
            @else
                <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
            @endif{{$estimates->client->name}}</td>
        <td class="text-muted">{{$client->email}}</td>
        <td class="text-muted">{{$client->city}}, {{$client->zipcode}}</td>
        <td class="text-muted">{{$client->phone}}</td>
        @php($data = explode(' ', $client->created_at))
        <td class="text-muted">{{$data[0]}}</td>
        <td width="1" class="text-center desktoptd last-child">
            <button class="btn btn-light btn-ellipsis" data-toggle="dropdown">
                <i class="uil uil-ellipsis-v"></i>
            </button>

            <div class="dropdown-menu dropdown-menu-right">
                <a onclick="$('#editModal').modal('show')" class="dropdown-item"
                   type="button">Edit</a>
                <button onclick="$('#deleteModal').modal('show')" class="dropdown-item deleteitem" type="button">Delete</button>
            </div>
        </td>
    </tr>
@endforeach
@else
    <td colspan="9" class="text-center">No Estimates found</td>
@endif

