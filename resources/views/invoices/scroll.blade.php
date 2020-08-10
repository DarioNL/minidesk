@if(count($estimates))
@foreach($estimates as $client)

    @include('clients.delete', ['client' => $client])
    @include('clients.edit', ['client' => $client])
    <tr class="clickable-row border-bottom" data-href="/clients/{{$client->id}}">
        <td class="pl-3">{{$client->first_name}}</td>
        <td class="pl-3">{{$client->last_name}}</td>
        <td class="pl-3">@if($client->company->logo != null)
                <img src="{{asset('/images/'.$client->company->id.$client->company->logo.'')}}" class="user-profile-img rounded-circle" alt="{{asset('/images/blank_profile_picture.png')}}">
            @else
                <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
            @endif{{$client->company->name}}</td>
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
    <td colspan="4">No clients found</td>
    <td width="1"></td>
@endif

