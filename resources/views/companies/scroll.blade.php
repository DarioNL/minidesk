@if(count($companies))
@foreach($companies as $company)

    @include('companies.delete', ['company' => $company])
    @include('companies.edit', ['company' => $company])
    <tr class="clickable-row border-bottom" data-href="/company/clients/{{$company->id}}">
        <td class="pl-3">{{$company->name}}</td>
        <td class="pl-3 desktoptd">@if($company->logo != null)
                <img src="{{asset($company->logo)}}" class="company-profile-img" alt="user logo">
            @else
                <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
            @endif</td>
        <td class="text-muted">{{$company->email}}</td>
        <td class="text-muted desktoptd">{{$company->city}}, {{$company->zipcode}}</td>
        <td class="text-muted">{{$company->phone}}</td>
        @php($data = explode(' ', $company->created_at))
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
    <td colspan="8" class="text-center">No Companies found</td>
@endif

