@extends('vendor.mail.html.header2')
@extends('vendor.mail.html.mail')

@section('content')
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:570px;">
        <tr>
            <td align="center"
                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">
                  Hello {{$estimate->client->first_name}} {{$estimate->client->last_name}} You have a new estimate!
                </h2>
            </td>
        </tr>
        <tr>
            <td align="center"
                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 20px; padding-bottom:20px">
                <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
                    @if($estimate->sign_id != null)
                    You can sign it <a class="btn btn-success" href="localhost:8000/estimates/{{$estimate->sign_id}}/sign">Sign</a>.
                    @else
                        This estimate is already accepted.
                    @endif
                </p>
            </td>
        </tr>
        <tr>
            <td align="left" style="padding-top: 20px;">
                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td width="75%" align="left"
                            style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding-bottom:30px">
                            Number
                        </td>
                        <td width="25%" align="left"
                            style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-bottom:30px">
                            {{$estimate->number}}
                        </td>
                    </tr>
                    <tr>
                        <td width="75%" align="left"
                            style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding-bottom:30px">
                            title
                        </td>
                        <td width="25%" align="left"
                            style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-bottom:30px">
                            @if($estimate->title != null)
                            {{$estimate->title}}
                            @else
                            {{$estimate->number}}
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="left"
                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
                    You can download the estimate below.<br><br> Regards,<br> Minidesk
                </p>
            </td>
        </tr>
    </table>
@endsection
