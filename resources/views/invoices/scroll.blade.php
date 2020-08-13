@if(count($invoices))
@foreach($invoices as $invoice)

    @include('invoices.delete', ['invoice' => $invoice])
    <tr class="clickable-row border-bottom" @auth('web') data-href="/company/invoices/{{$invoice->id}}" @else data-href="/client/invoices/{{$invoice->id}}" @endauth>
        <td class="pl-3">{{$invoice->number}}</td>
        @if($invoice->title != null)
            <td class="text-muted">{{$invoice->title}}</td>
        @else
            <td class="text-muted">{{$invoice->number}}</td>
        @endif
        <td class="pl-3">@if($invoice->company->logo != null)
                <img src="{{asset('/images/'.$invoice->company->id.$invoice->company->logo.'')}}" class="user-profile-img rounded-circle" alt="{{asset('/images/blank_profile_picture.png')}}">
            @else
                <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
            @endif{{$invoice->company->name}}</td>
        <td class="pl-3">@if($invoice->client->logo != null)
                <img src="{{asset('/images/'.$invoice->client->id.$invoice->client->logo.'')}}" class="user-profile-img rounded-circle" alt="{{asset('/images/blank_profile_picture.png')}}">
            @else
                <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
            @endif{{$invoice->client->first_name}} {{$invoice->client->last_name}}</td>
        <td class="text-muted">€{{$invoice->total}}</td>
        @if($invoice->send_date != null)
        @php($date = explode(' ', $invoice->send_date))
            <td class="text-muted">{{$date[0]}}</td>
        @else
            <td class="text-muted">Not sent</td>
        @endif
        @php($dueDate = explode(' ', $invoice->due_date))
        <td class="text-muted">{{$dueDate[0]}}</td>
        @if($invoice->pay_date != null)
            @php($payDate = explode(' ', $invoice->pay_date))
            <td class="text-muted">{{$payDate[0]}}</td>
        @else
            <td class="text-muted">Not signed</td>
        @endif
        @php($data = explode(' ', $invoice->created_at))
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
    <td colspan="10" class="text-center">No Invoices found</td>
@endif

