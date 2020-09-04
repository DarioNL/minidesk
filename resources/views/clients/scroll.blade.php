@if(count($clients))
@foreach($clients as $client)

    @include('clients.delete', ['client' => $client])
    @include('clients.edit', ['client' => $client])
    @auth('admins')
        @include('clients.link', ['companies' => $companies, 'client' => $client])
        @include('clients.unlink', ['client' => $client])
    @else
        @include('clients.unlink', ['client' => $client])
    @endauth
    <tr class="clickable-row border-bottom" data-href="/company/clients/{{$client->id}}">
        <td class="pl-3">{{$client->first_name}}</td>
        <td class="pl-3">{{$client->last_name}}</td>
        <td class="pl-3 desktoptd">@if($client->company->logo != null)
                <img src="{{asset($client->company->logo)}}" class="company-profile-img" alt="user logo">
            @else
                <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
            @endif{{$client->company->name}}</td>
        <td class="text-muted">{{$client->email}}</td>
        <td class="text-muted desktoptd">{{$client->city}}, {{$client->zipcode}}</td>
        <td class="text-muted">{{$client->phone}}</td>
        @php($data = explode(' ', $client->created_at))
        <td class="text-muted desktoptd">{{$data[0]}}</td>
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
    <td colspan="8" class="text-center">No Clients found</td>
@endif

