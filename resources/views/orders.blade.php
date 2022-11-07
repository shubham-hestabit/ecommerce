@extends('layouts.app')

@section('content')
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block" id="msg">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="container px-3 py-5 clearfix">
        <div class="card">
            @if ($message = Session::get('success'))
                <div class="alert alert-info" id="msg">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{{ $message }}</strong>
                    <script>
                        setTimeout(function() {
                            $("#msg").hide();
                        }, 7000);
                    </script>
                </div>
            @endif
            <div class="card-header text-center">
                <h1 class="font-weight-bold">Your Orders</h1>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered m-0">
                        <thead>
                            <tr class="text-center">
                                <th>Order Image</th>
                                <th>Order Name</th>
                                <th>Order Details</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Invoice</th>
                                <th>Return</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($items as $item)
                                <tr>
                                    <td width="160">
                                        <img src="{{ '/storage/product-images/' . $item->image }}"
                                            class="d-block border border-secondary" alt="" height=100 />
                                    </td>
                                    <td class="align-middle">{{ $item->name }}</td>
                                    <td class="align-middle">{{ $item->details }}</td>
                                    <td class="align-middle">{{ $item->quantity }}</td>
                                    <td class="align-middle">{{ $item->price }}</td>
                                    <td class="align-middle">
                                        <a href="{{ url('/order-invoice') }}"
                                            class="btn btn-primary font-weight-bold">Invoice</a>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-warning font-weight-bold" id='refund'
                                            onclick="return_item();">
                                            <a href="{{ route('refund-payment', 2) }}">Return</a>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function return_item() {
            var refund = document.getElementById('refund');
            if (confirm("Are you really want to return this item?")) {
                refund.innerHTML = "Returned!";
                if ({{ $orders->is_returned }}) {
                    $s = {{ $orders->is_returned = 1 }};
                }
                refund.style.backgroundColor = "red";
                refund.style.color = "white";
            }
            if (refund.innerHTML = "Returned!") {
                alert('This item refund is already done.');
            }
        }
    </script>
@endsection
