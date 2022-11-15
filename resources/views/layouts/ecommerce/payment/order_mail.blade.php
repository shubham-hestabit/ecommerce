<html>

<head>
    <title>Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
    <table class="d-flex" width="100%" style="max-width:600px;">
        <tr>
            <td>
                <img src="https://www.freeiconspng.com/uploads/green-check-mark-symbol-7.jpg" alt=""
                    width="100px" height="100px" style="margin-left: 170px;">
                <h2 style="font-size: 35px;">Thank You For Your Order!</h2>
            </td>
        </tr>
        <tr>
            <td>
                <div class="bg-secondary py-2">Order Confirmation # {{ $order_id }}</div>
            </td>
            <table width="100%" class="my-4 table-bordered">
                <thead>
                    <td class="py-2"><b>Item</b></td>
                    <td><b>Qty</b></td>
                    <td><b>Price</b></td>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr class="py-2">
                            <td class="py-2">{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ $item->price }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        @if ($total_amount < 500)
                            @php
                                $shipping = 50;
                            @endphp
                        @else
                            $shipping = 0;
                        @endif
                        <td colspan="2" class="py-2">Shipping</td>
                        <td>${{ $shipping }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="py-2"><b>TOTAL</b></td>
                        <td><b>${{ $total_amount }}</b></td>
                    </tr>
                </tbody>
            </table>
            </td>
        </tr>
    </table>
</body>

</html>
