@if(count($estimates))
@foreach($estimates as $estimate)

    @include('estimates.delete', ['estimate' => $estimate])
    <tr class="clickable-row border-bottom" @auth('web') data-href="/company/estimates/{{$estimate->id}}" @else data-href="/client/estimates/{{$estimate->id}}" @endauth">
        <td class="pl-3">{{$estimate->number}}</td>
        @if($estimate->title != null)
            <td class="text-muted">{{$estimate->title}}</td>
        @else
            <td class="text-muted">{{$estimate->number}}</td>
        @endif
        <td class="pl-3">@if($estimate->company->logo != null)
                <img src="{{asset('/images/'.$estimate->company->id.$estimates->company->logo.'')}}" class="user-profile-img rounded-circle" alt="{{asset('/images/blank_profile_picture.png')}}">
            @else
                <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
            @endif{{$estimate->company->name}}</td>
        <td class="pl-3">@if($estimate->client->logo != null)
                <img src="{{asset('/images/'.$estimate->client->id.$estimate->client->logo.'')}}" class="user-profile-img rounded-circle" alt="{{asset('/images/blank_profile_picture.png')}}">
            @else
                <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
            @endif{{$estimate->client->first_name}} {{$estimate->client->last_name}}</td>
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
            </div>
        </td>
        @endauth
    </tr>

@endforeach
    </tbody>
    </table>
@else
    <td colspan="10" class="text-center">No Estimates found</td>
@endif

