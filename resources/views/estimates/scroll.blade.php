@if(count($estimates))
@foreach($estimates as $estimate)

    @auth('web')
    @include('estimates.delete', ['estimate' => $estimate])
    @if(!$estimate->client)
    @include('estimates.link', ['estimate' => $estimate])
    @else
    @include('estimates.unlink', ['estimate' => $estimate])
    @endif
    @elseauth('admins')
        @include('estimates.delete', ['estimate' => $estimate])
        @if(!$estimate->client)
            @include('estimates.link', ['estimate' => $estimate])
        @else
            @include('estimates.unlink', ['estimate' => $estimate,])
        @endif
        @if(!$estimate->company)
            @include('estimates.admin.linkCompany', ['estimate' => $estimate])
        @else
            @include('estimates.admin.unlinkCompany', ['estimate' => $estimate, 'company' => $estimate->company])
        @endif
    @endauth
    <tr class="clickable-row border-bottom" @auth('web') data-href="/company/estimates/{{$estimate->id}}" @else data-href="/client/estimates/{{$estimate->id}}" @endauth">
        <td class="pl-3 desktoptd">{{$estimate->number}}</td>
        @if($estimate->title != null)
            <td class="text-muted">{{$estimate->title}}</td>
        @else
            <td class="text-muted">{{$estimate->number}}</td>
        @endif
    @if(!$estimate->company)
        <td class="pl-3 desktoptd">
            No company
        </td>
    @else
        <td class="pl-3 desktoptd">@if($estimate->company->logo != null)
                <img src="{{asset($estimate->company->logo)}}" class="company-profile-img" alt="user logo">
            @else
                <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
            @endif{{$estimate->company->name}}</td>
        @endif
    @if($estimate->client)
        <td class="pl-3">@if($estimate->client->logo != null)
                <img src="{{asset($estimate->client->logo)}}" class="sidebar-logo d-block ui-w-30 bg-white rounded-circle" alt="user logo">
            @else
                <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
            @endif{{$estimate->client->first_name}} {{$estimate->client->last_name}}</td>
    @else
        <td>No client</td>
    @endif
        <td class="text-muted">€{{$estimate->total}}</td>
        @if($estimate->send_at != null)
        @php($date = explode(' ', $estimate->Send_at))
            <td class="text-muted desktoptd">{{$date[0]}}</td>
        @else
            <td class="text-muted desktoptd">Not sent</td>
        @endif
        @php($dueDate = explode(' ', $estimate->due_date))
        <td class="text-muted desktoptd">{{$dueDate[0]}}</td>
        @if($estimate->sign_date != null)
            @php($signDate = explode(' ', $estimate->sign_date))
            <td class="text-success">{{$signDate[0]}}</td>
        @else
            <td class="text-danger">Not signed</td>
        @endif
        @php($data = explode(' ', $estimate->created_at))
        <td class="text-muted desktoptd">{{$data[0]}}</td>
    @auth('web')
        <td width="1" class="text-center desktoptd last-child">
            <button class="btn btn-light btn-ellipsis" data-toggle="dropdown">
                <i class="uil uil-ellipsis-v"></i>
            </button>

            <div class="dropdown-menu dropdown-menu-right">
                <button onclick="$('#deleteModal').modal('show')" class="dropdown-item deleteitem" type="button">Delete</button>
                @if(!$estimate->client)
                <button onclick="$('#linkModal').modal('show')" class="dropdown-item deleteitem" type="button">Link</button>
                @else
                <button onclick="$('#unlinkModal').modal('show')" class="dropdown-item deleteitem" type="button">Unlink</button>
                @endif
            </div>
        </td>
        @elseauth('admins')
        <td width="1" class="text-center desktoptd last-child">
            <button class="btn btn-light btn-ellipsis" data-toggle="dropdown">
                <i class="uil uil-ellipsis-v"></i>
            </button>

            <div class="dropdown-menu dropdown-menu-right">
                <button onclick="$('#deleteModal').modal('show')" class="dropdown-item deleteitem" type="button">Delete</button>
                @if(!$estimate->client)
                    <button onclick="$('#linkModal').modal('show')" class="dropdown-item deleteitem" type="button">Link CLient</button>
                @else
                    <button onclick="$('#unlinkModal').modal('show')" class="dropdown-item deleteitem" type="button">Unlink Client</button>
                @endif
                @if(!$estimate->company)
                    <button onclick="$('#linkCompanyModal').modal('show')" class="dropdown-item deleteitem" type="button">Link Company</button>
                @else
                    <button onclick="$('#unlinkCompanyModal').modal('show')" class="dropdown-item deleteitem" type="button">Unlink Company</button>
                @endif
            </div>
        </td>
        @endauth
    </tr>

@endforeach
@else
    <td colspan="10" class="text-center">No Estimates found</td>
@endif

