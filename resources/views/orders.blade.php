@extends('layouts.app')

@section('content')
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block" id="msg">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <script>
        setTimeout(function() {
            $("#msg").hide();
        }, 7000);
    </script>
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
            <p>{{ $order->is_returned }}</p>
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
                                    <td class="align-middle" id="product_return">{{ $item->is_returned }}</td>
                                    <td class="align-middle">
                                        <a href="{{ url('/order-invoice') }}"
                                            class="btn btn-primary font-weight-bold">Invoice</a>
                                    </td>
                                    <td class="align-middle">
                                        @if (!$item->is_returned)
                                            <a class="btn btn-warning font-weight-bold"
                                                href="{{ route('refund-payment', $item->item_id) }}"
                                                onclick="returnButton();">Return
                                            </a>
                                        @else
                                            <button class="btn btn-danger font-weight-bold"
                                                onclick="alert('Item already returned or refunded.');">Returned!!
                                            </button>
                                        @endif
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
        function returnButton() {
            if (confirm('Are you really want to return this item?')) {
                return true;
            } else {
                event.stopPropagation();
                event.preventDefault();
            };
        }
    </script>
@endsection
