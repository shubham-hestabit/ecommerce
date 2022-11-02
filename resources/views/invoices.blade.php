<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Some Random Title</title>
    <style>
    body {
        font-family: "Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace !important;
        letter-spacing: -0.3px;
    }

    .invoice-wrapper {
        width: 700px;
        margin: auto;
    }

    .nav-sidebar .nav-header:not(:first-of-type) {
        padding: 1.7rem 0rem .5rem;
    }

    .logo {
        font-size: 50px;
    }

    .sidebar-collapse .brand-link .brand-image {
        margin-top: -33px;
    }

    .content-wrapper {
        margin: auto !important;
    }

    .billing-company-image {
        width: 50px;
    }

    .billing_name {
        text-transform: uppercase;
    }

    .billing_address {
        text-transform: capitalize;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        text-align: left;
        padding: 10px;
    }

    td {
        padding: 10px;
        vertical-align: top;
    }

    .row {
        display: block;
        clear: both;
    }

    .text-right {
        text-align: right;
    }

    .table-hover thead tr {
        background: #eee;
    }

    .table-hover tbody tr:nth-child(even) {
        background: #fbf9f9;
    }

    address {
        font-style: normal;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h2>Invoice</h2>
                    <h3 class="pull-right">Order# 12345</h3>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        <address>
                            <strong>Billed To:</strong><br>
                            {{ $billing_address['name'] }}<br>
                            {{ $billing_address['line1'] }}<br>
                            {{ $billing_address['city'] }}<br>
                            {{ $billing_address['state'] }}<br>
                            {{ $billing_address['country'] }}, {{ $billing_address['postal_code'] }}<br>
                        </address>
                    </div>
                    <div class="col-xs-6 text-right">
                        <address>
                            <strong>Shipped To:</strong><br>
                            {{ $shipping_address['name'] }}<br>
                            {{ $shipping_address['line1'] }}<br>
                            {{ $shipping_address['city'] }}<br>
                            {{ $shipping_address['state'] }}<br>
                            {{ $shipping_address['country'] }}, {{ $shipping_address['postal_code'] }}<br>
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <address>
                            <strong>Payment Method:</strong><br>
                            {{-- $payment_details['card_num'] --}}<br>
                            {{ $payment_details['email'] }}
                        </address>
                    </div>
                    <div class="col-xs-6 text-right">
                        <address>
                            <strong>Order Date:</strong><br>
                            {{ $date}}<br><br>
                        </address>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Order summary</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <td><strong>Item</strong></td>
                                        <td class="text-center"><strong>Detail</strong></td>
                                        <td class="text-center"><strong>Quantity</strong></td>
                                        <td class="text-right"><strong>Price</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                    @foreach ($cartItems as $item)
                                    <tr>
                                        <td>{{ $product['product_name'] }}</td>
                                        <td class="text-center">${{ $product['product_details'] }}</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">${{ $product['product_price'] }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td>BS-400</td>
                                        <td class="text-center">$20.00</td>
                                        <td class="text-center">3</td>
                                        <td class="text-right">$60.00</td>
                                    </tr>
                                    <tr>
                                        <td>BS-1000</td>
                                        <td class="text-center">$600.00</td>
                                        <td class="text-center">1</td>
                                        <td class="text-right">$600.00</td>
                                    </tr>
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                        <td class="thick-line text-right">${{ $sub_total }}</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Shipping</strong></td>
                                        <td class="no-line text-right">${{ $shipping }}</td>
                                    </tr>
                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Total</strong></td>
                                        <td class="no-line text-right">${{ $total_amount }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>