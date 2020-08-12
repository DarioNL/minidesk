
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
                {{$invoice->company->name}}
            </h1>
        </div>
    </div>

    <div style="margin-bottom: 0px">&nbsp;</div>

    <div class="row">
        <div class="col-xs-6">
            <h4>To:</h4>
            <address>
                <strong>{{$invoice->client->first_name}} {{$invoice->client->last_name}}</strong><br>
                <span>{{$invoice->client->email}}.</span> <br>
                <span>{{$invoice->client->house_number}} {{$invoice->client->address}}.</span> <br>
                <span>{{$invoice->client->zipcode}} {{$invoice->client->city}}.</span> <br>
            </address>
        </div>

        <div class="col-xs-5">
            <table style="width: 100%">
                <tbody>
                <tr>
                    <th>Invoice Number:</th>
                    <td class="text-right">{{$invoice->number}}</td>
                </tr>
                <tr>
                    <th>Invoice Title:</th>
                    <td class="text-right">@if($invoice->title != null) {{$invoice->title}} @else{{$invoice->number}} @endif</td>
                </tr>
                <tr>
                    <th> Due Date: </th>
                    @php($dueDate = explode(' ', $invoice->due_date))
                    <td class="text-right">{{$dueDate[0]}}</td>
                </tr>
                </tbody>
            </table>

            <div style="margin-bottom: 0px">&nbsp;</div>

            <table style="width: 100%; margin-bottom: 20px">
                <tbody>
                <tr class="well" style="padding: 5px">
                    <th style="padding: 5px"><div> Total Price </div></th>
                    <td style="padding: 5px" class="text-right"><strong> €{{$invoice->total}} </strong></td>
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
        @foreach($invoice->products as $product)
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
                    <td style="padding: 5px" class="text-right"><strong> {{$invoice->discount}}%  -€{{$invoice->amount}}</strong></td>
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
            <h4>Payment Terms</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad eius quia, aut doloremque, voluptatibus quam ipsa sit sed enim nam dicta. Soluta eaque rem necessitatibus commodi, autem facilis iusto impedit!</p>
        </div>
    </div>

    <div>
        <strong>{{$invoice->company->name}}</strong><br>
        {{$invoice->company->house_number}} {{$invoice->company->address}}. <br>
        <span>{{$invoice->company->zipcode}} {{$invoice->company->city}}<br>
        P: {{$invoice->company->phone}} <br>
        E: {{$invoice->company->email}} <br>

        <br>
    </div>
</div>

</body>
</html>
