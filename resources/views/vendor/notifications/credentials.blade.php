@extends('vendor.mail.html.header')
@extends('vendor.mail.html.mail')

@section('content')
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:570px;">
        <tr>
            <td align="center"
                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;">
                  Hello @if(!empty($client->firstname)){{$client->first_name}} {{$client->last_name}}@else {{$client->name}} @endif! here is your login info!
                </h2>
            </td>
        </tr>
        <tr>
            <td align="center"
                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 20px; padding-bottom:20px">
                <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
                    You can login <a href="{{env('APP_URL')}}/login">here</a>. Or paste this url in your
                    browser: {{env('APP_URL')}}/login
                </p>
            </td>
        </tr>
        <tr>
            <td align="left" style="padding-top: 20px;">
                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td width="75%" align="left"
                            style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding-bottom:30px">
                            Email
                        </td>
                        <td width="25%" align="left"
                            style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-bottom:30px">
                            {{$client->email}}
                        </td>
                    </tr>
                    <tr>
                        <td width="75%" align="left"
                            style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding-bottom:30px">
                            Password
                        </td>
                        <td width="25%" align="left"
                            style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-bottom:30px">
                            {{$password}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="left"
                style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;">
                    For the best security change the password as soon as possible<br><br> Regards,<br> Minidesk
                </p>
            </td>
        </tr>
    </table>
@endsection
