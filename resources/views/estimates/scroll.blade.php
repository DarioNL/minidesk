@if(count($estimates))
@foreach($estimates as $estimate)

    @include('estimates.delete', ['estimate' => $estimate])
    @if(!$estimate->client)
    @include('estimates.link', ['estimate' => $estimate])
    @else
    @include('estimates.unlink', ['estimate' => $estimate])
    @endif
    <tr class="clickable-row border-bottom" @auth('web') data-href="/company/estimates/{{$estimate->id}}" @else data-href="/client/estimates/{{$estimate->id}}" @endauth">
        <td class="pl-3">{{$estimate->number}}</td>
        @if($estimate->title != null)
            <td class="text-muted">{{$estimate->title}}</td>
        @else
            <td class="text-muted">{{$estimate->number}}</td>
        @endif
        <td class="pl-3">@if($estimate->company->logo != null)
                <img src="{{asset($estimate->company->logo)}}" class="company-profile-img" alt="user logo">
            @else
                <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
            @endif{{$estimate->company->name}}</td>
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
            <td class="text-muted">{{$date[0]}}</td>
        @else
            <td class="text-muted">Not sent</td>
        @endif
        @php($dueDate = explode(' ', $estimate->due_date))
        <td class="text-muted">{{$dueDate[0]}}</td>
        @if($estimate->signed_at != null)
            @php($signDate = explode(' ', $estimate->signed_at))
            <td class="text-muted">{{$signDate[0]}}</td>
        @else
            <td class="text-muted">Not signed</td>
        @endif
        @php($data = explode(' ', $estimate->created_at))
        <td class="text-muted">{{$data[0]}}</td>
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
        @endauth
    </tr>

@endforeach
@else
    <td colspan="10" class="text-center">No Estimates found</td>
@endif

