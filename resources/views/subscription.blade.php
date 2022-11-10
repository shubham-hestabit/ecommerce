@extends('layouts.app')

@section('content')
    <style>
        :root {
            --main-color: #06CA81;
        }

        .pricingTable {
            color: var(--main-color);
            background: var(--main-color);
            font-family: 'Ubuntu', sans-serif;
            text-align: center;
            padding: 75px 10px 35px;
            border-radius: 70px;
            position: relative;
            z-index: 1;
        }

        .pricingTable:before {
            content: '';
            background-color: #fff;
            border-radius: 60px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            position: absolute;
            left: 20px;
            right: 20px;
            top: 20px;
            bottom: 20px;
            z-index: -1;
        }

        .pricingTable .title {
            color: #fff;
            background-color: var(--main-color);
            font-size: 45px;
            font-weight: 400;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 10px;
            margin: 0 0 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .pricingTable .pricing-content {
            text-align: left;
            padding: 0;
            margin: 0 0 30px;
            list-style: none;
            display: inline-block;
        }

        .pricingTable .pricing-content li {
            color: #333;
            font-size: 19px;
            font-weight: 500;
            line-height: 40px;
            padding: 0 15px 0 35px;
            margin: 0 0 10px;
            position: relative;
        }

        .pricingTable .pricing-content li:last-child {
            margin: 0;
        }

        .pricingTable .pricing-content li:before {
            content: "\f00c";
            color: #349008;
            font-family: "Font Awesome 5 free";
            font-weight: 900;
            position: absolute;
            top: 1px;
            left: 8px;
        }

        .pricingTable .pricing-content li.disable:before {
            content: "\f00d";
            color: #FF3A39;
        }

        .pricingTable .price-value button {
            color: var(--main-color);
            font-size: 27px;
            font-weight: 500;
            width: 60%;
            padding: 4px 10px;
            margin: 0 auto 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        }

        .pricingTable button {
            color: var(--main-color);
            background: #fff;
            font-size: 25px;
            font-weight: 600;
            text-transform: capitalize;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .pricingTable button:hover {
            text-shadow: 0 5px 5px #aaa;
        }

        .pricingTable.purple {
            --main-color: #A955FA;
        }
    </style>

    <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block mt-3" id="msg">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block mt-3" id="msg">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <script>
            setTimeout(function() {
                $("#msg").hide();
            }, 7000);
        </script>
        <div class="row ml-5">
            <div class="col-md-4 mt-5 ml-5">
                <div class="pricingTable mt-5">
                    <div class="pricingTable-header">
                        <h3 class="title">General</h3>
                    </div>
                    <ul class="pricing-content">
                        <li>Life Time Access</li>
                        <li class="disable">Fast Delivery</li>
                        <li class="disable">Return Available</li>
                    </ul>
                    <div class="price-value">
                        @if (!Auth::user()->is_subscribed)
                            <button type="button" style="border: none"
                                onclick="alert('This plan is already ative.');">$0/Month</button>
                        @else
                            <button type="button" style="border: none"
                                onclick="alert('You already subscribed our premium plan.');">$0/Month</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-5 ml-5">
                <div class="pricingTable purple mt-5">
                    <div class="pricingTable-header">
                        <h3 class="title">Premium</h3>
                    </div>
                    <ul class="pricing-content">
                        <li>Life Time Access</li>
                        <li>Fast Delivery</li>
                        <li>Return Available</li>
                    </ul>
                    <div class="price-value">
                        @if (!Auth::user()->is_subscribed)
                            <form action="{{ route('subscription-payment') }}" method="POST">
                                @csrf
                                <button type="submit" style="border:none">${{ $amount }}/Month</button>
                            </form>
                        @else
                            <small style="font-size: 15px; color:black;">Valid till:&ensp;{{ $date }}</small>
                            <button style="border:none; color:white; background:red;  border:1px solid black;"
                                onclick="alert('Subscription is already active.');">
                                <b>Subscribed</b><br>
                            </button><br>
                            <a href="{{ route('unsubscribed') }}" onclick="alert('Subscription deactivated.');">
                                Cancel Subscription</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
