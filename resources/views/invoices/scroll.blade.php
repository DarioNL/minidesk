@if(count($invoices))
@foreach($invoices as $invoice)

    @include('invoices.delete', ['invoice' => $invoice])
    @if(!$invoice->client)
        @include('invoices.link', ['invoice' => $invoice])
    @else
        @include('invoices.unlink', ['invoice' => $invoice])
    @endif
    <tr class="clickable-row border-bottom" @auth('web') data-href="/company/invoices/{{$invoice->id}}" @else data-href="/client/invoices/{{$invoice->id}}" @endauth>
        <td class="pl-3">{{$invoice->number}}</td>
        @if($invoice->title != null)
            <td class="text-muted">{{$invoice->title}}</td>
        @else
            <td class="text-muted">{{$invoice->number}}</td>
        @endif
        <td class="pl-3">@if($invoice->company->logo != null)
                <img src="{{asset($invoice->company->logo)}}" class="company-profile-img" alt="user logo">
            @else
                <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
            @endif{{$invoice->company->name}}</td>
        @if($invoice->client)
        <td class="pl-3">@if($invoice->client->logo != null)
                <img src="{{asset($estimate->company->logo)}}" class="user-profile-img rounded-circle" alt="user logo">
            @else
                <img src="{{asset('/images/blank_profile_picture.png')}}" class="user-profile-img rounded-circle" alt="">
            @endif{{$invoice->client->first_name}} {{$invoice->client->last_name}}</td>
        @else
            <td>No Client</td>
        @endif
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
                @if(!$invoice->client)
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
    <td colspan="10" class="text-center">No Invoices found</td>
@endif

