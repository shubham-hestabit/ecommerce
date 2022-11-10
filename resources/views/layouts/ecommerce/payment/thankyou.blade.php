@extends('layouts.app')

@section('content')
    <div class="py-5">
        <div class="d-flex justify-content-center align-items-center">
            <h1 class="font-weight-bolder" style="font-size: 9rem;">THANK YOU!</h1>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <i class="fa fa-check text-success mb-4" style="font-size: 10rem;"></i>
        </div>
        <div class="d-flex justify-content-center align-items-center mt-3">
            <p class="display-6" style="font-size: 2rem ">Thanks for Shopping!!</p>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <a href="{{ route('payment-invoice', $order_id) }}"
                class="btn btn-info btn-lg text-dark mt-3 border-dark display-5"><b>View Invoice</b></a>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <a href="{{ url('/product') }}" class="fa fa-cart-plus btn-lg btn-warning border border-dark mt-5">&nbsp;&nbsp;
                <b>Back to Shopping</b></a>
        </div>
    </div>
@endsection
