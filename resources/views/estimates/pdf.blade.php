
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">

    <title>Invoice</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <style>
        .text-right {
            text-align: right;
        }
    </style>

</head>
<body class="login-page" style="background: white">

<div>
    <div class="row">


        <div class="col-xs-4">
            <h1>
                {{$estimate->company->name}}
            </h1>
        </div>
    </div>

    <div style="margin-bottom: 0px">&nbsp;</div>

    <div class="row">
        <div class="col-xs-6">
            <h4>To:</h4>
            <address>
                <strong>{{$estimate->client->first_name}} {{$estimate->client->last_name}}</strong><br>
                <span>{{$estimate->client->email}}.</span> <br>
                <span>{{$estimate->client->house_number}} {{$estimate->client->address}}.</span> <br>
                <span>{{$estimate->client->zipcode}} {{$estimate->client->city}}.</span> <br>
            </address>
        </div>

        <div class="col-xs-5">
            <table style="width: 100%">
                <tbody>
                <tr>
                    <th>Estimate Number:</th>
                    <td class="text-right">{{$estimate->number}}</td>
                </tr>
                <tr>
                    <th>Estimate Title:</th>
                    <td class="text-right">@if($estimate->title != null) {{$estimate->title}} @else{{$estimate->number}} @endif</td>
                </tr>
                <tr>
                    <th> Due Date: </th>
                    @php($dueDate = explode(' ', $estimate->due_date))
                    <td class="text-right">{{$dueDate[0]}}</td>
                </tr>
                </tbody>
            </table>

            <div style="margin-bottom: 0px">&nbsp;</div>

            <table style="width: 100%; margin-bottom: 20px">
                <tbody>
                <tr class="well" style="padding: 5px">
                    <th style="padding: 5px"><div> Total Price </div></th>
                    <td style="padding: 5px" class="text-right"><strong> €{{$estimate->total}} </strong></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <table class="table">
        <thead style="background: #F5F5F5;">
        <tr>
            <th class="text-left">Amount</th>
            <th>Description</th>
            <th>Price</th>
            <th>Tax</th>
            <th class="text-right">total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($estimate->products as $product)
        <tr>
            <td>{{$product->amount}}</td>
            <td>{{$product->description}}</td>
            <td>€{{$product->price}}</td>
            <td>{{$product->tax}}%</td>
            <td class="text-right">{{$product->total}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-xs-6"></div>
        <div class="col-xs-5">
            <table style="width: 100%">
                <tbody>
                <tr class="well" style="padding: 5px">
                    <th style="padding: 5px"><div> Discount % </div></th>
                    <td style="padding: 5px" class="text-right"><strong> {{$estimate->discount}}%  -€{{$estimate->amount}}</strong></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-bottom: 0px">&nbsp;</div>

    <div class="row">
        <div class="col-xs-8 invbody-terms">
            Thank you for your business. <br>
            <br>
        </div>
    </div>

    <div>
        <strong>{{$estimate->company->name}}</strong><br>
        {{$estimate->company->house_number}} {{$estimate->company->address}}. <br>
        <span>{{$estimate->company->zipcode}} {{$estimate->company->city}}<br>
        P: {{$estimate->company->phone}} <br>
        E: {{$estimate->company->email}} <br>

        <br>
    </div>
</div>

</body>
</html>
