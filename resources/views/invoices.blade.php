<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Payment Invoice</title>
    <style>
    body {
        font-family: "Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace !important;
        letter-spacing: -0.3px;
    }

    .invoice-title h2 {
        font-size: 30px;
        text-align: center;
    }

    .invoice-title h3 {
        text-align: center;
    }

    .shipping {
        margin-top: -100px;
        text-align: right;
    }

    .payment {
        margin-top: 30px;
    }

    .date {
        margin-top: -50px;
        text-align: right;
    }

    .panel-title {
        margin-top: 20px;
        font-size: 23px;
        text-align: center;
    }

    table,
    th,
    td {
        border: 2px solid black;
        border-collapse: collapse;
        text-align: center;
        height: 30px;
    }
    </style>
</head>

<body>
    <div class='container'>
        <div class="invoice-title">
            <h2>Invoice</h2>

            <h3 class="pull-right">Order# {{ $orderNum }}</h3>
        </div>
        <hr>
        <div class="billing">
            <address>
                <strong>Billed To:</strong><br>
                {{ $billing_address['name'] }}<br>
                {{ $billing_address['address']['line1'] }}<br>
                {{ $billing_address['address']['city'] }}<br>
                {{ $billing_address['address']['country'] }},{{ $billing_address['address']['postal_code'] }}<br>
            </address>
        </div>
        <div class="shipping">
            <address>
                <strong>Shipped To:</strong><br>
                {{ $shipping_address['name'] }}<br>
                {{ $shipping_address['address']['line1'] }}<br>
                {{ $shipping_address['address']['city'] }}<br>
                {{ $shipping_address['address']['country'] }},{{ $shipping_address['address']['postal_code'] }}<br>
            </address>
        </div>
        <div class="payment">
            <address>
                <strong>Payment Method:</strong><br>
                {{ $payment_details['card']['brand'] }} ending xxxx{{ $payment_details['card']['last4'] }}<br>
                pay through: {{ $payment_details['type'] }}<br>
            </address>
        </div>
        <div class="date">
            <address>
                <strong>Order Date:</strong><br>{{ $date }}<br>{{ $time }}<br>

            </address>
        </div>
    </div>

    <hr>

    <div class="container">
        <h3 class="panel-title"><strong>Order Summary</strong></h3>
        <table style="width:100%">
            <thead style="font-size:20px">
                <tr>
                    <td><strong>Item</strong></td>
                    <td><strong>Details</strong></td>
                    <td><strong>Qty</strong></td>
                    <td><strong>Price</strong></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->attributes->details }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" style="text-align:right;"><strong>Subtotal</strong>&nbsp;&nbsp;</td>
                    <td><strong>${{ number_format($sub_total, 2) }}</strong></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:right;"><strong>Shipping</strong>&nbsp;&nbsp;</td>
                    <td><strong>${{ number_format($shipping_charge, 2) }}</strong></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align:right;"><strong>Total</strong>&nbsp;&nbsp;</td>
                    <td><strong>${{ number_format($total_amount, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
        <footer style="text-align:center; margin-top:200px;">
            <p>**************************************<br>**************************<br>**************</p>
        </footer>
    </div>
</body>

</html>