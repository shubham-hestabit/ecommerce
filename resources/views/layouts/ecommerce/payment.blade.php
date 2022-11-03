@extends('layouts.app')

@section('content')

<div class="container py-4">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block" id="msg">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
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
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col">
            <div class='error form-group d-none'>
                <div class='alert alert-danger' id='cardError'></div>
            </div>
            <div class="card my-2 shadow-3  border border-secondary">
                <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
                <form name="paymentForm" role="form" action="{{ route('make-payment') }}" method="post"
                    class="require-validation" data-cc-on-file="false"
                    data-stripe-publishable-key="{{ env('STRIPE_PUBLISHED_KEY') }}" id="payment-form">
                    @csrf
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card-body p-md-5 text-black">
                                <h3 class="mb-4 text-uppercase">Delivery Info</h3>
                                <div class="form-outline mb-4">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control form-control-lg" required />
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control form-control-lg" required />
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control form-control-lg" required />
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">State</label>
                                        <input type="text" name="state" class="form-control form-control-lg" required />
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">City</label>
                                        <input type="text" name="city" class="form-control form-control-lg" required />
                                    </div>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label">Zip Code</label>
                                    <input type="text" name="zipcode" class="form-control form-control-lg" required />
                                </div>
                                <div class="d-flex justify-content-around pt-3">
                                    <a href="{{ url('/cart')}}" class="btn btn-dark btn-lg mr-5"><i
                                            class="fa fa-arrow-left"></i> Back to Cart</a>
                                    <button type="button" class="btn btn-primary btn-lg ml-5" onclick="order()"
                                        id="confirmOrder">Confirm Order</button>
                                </div>
                            </div>
                        </div>

                        @foreach ($cartItems as $item)
                        <input type="hidden" name="p_name" value="{{ $item->name }}">
                        <input type="hidden" name="p_details" value="{{ $item->details }}">
                        <input type="hidden" name="p_price" value="{{ $item->price }}">
                        @endforeach

                        <div class="col-lg-5 mt-4 ml-4">
                            <div class="card bg-light text-white rounded-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h2 class="mb-0">Card details</h2>
                                    </div>
                                    <p class="medium mb-1 font-weight-bold">Card type</p>
                                    <img class="ml-2" width="45px"
                                        src="https://cdn-icons-png.flaticon.com/512/349/349221.png" alt="Visa" />
                                    <img class="ml-2" width="45px"
                                        src="https://cdn-icons-png.flaticon.com/512/349/349228.png"
                                        alt="AmericanExpress" />
                                    <img class="ml-2" width="45px"
                                        src="https://cdn-icons-png.flaticon.com/128/825/825464.png" alt="Mastercard" />
                                    <img class="ml-2" width="45px"
                                        src="https://cdn-icons-png.flaticon.com/128/1440/1440517.png" alt="PayPal" />
                                    <!-- <img class="ml-2" width="45px"
                                        src="https://cdn-icons-png.flaticon.com/128/349/349230.png" alt="Discovery" />
                                    <img class="ml-2" width="45px"
                                        src="https://cdn-icons-png.flaticon.com/128/5968/5968382.png" alt="Stripe" /> -->

                                    <div class="form-outline form-white mt-2 required">
                                        <label class="form-label">Cardholder's Name</label>
                                        <input type="text" name="cardName" class="form-control form-control-lg"
                                            placeholder="Cardholder's Name" required />
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label">Card Number</label>
                                        <input type="text" name="cardNumber" id="cardNumber"
                                            class="form-control form-control-lg card-number"
                                            placeholder="1234 5678 9012 3457" maxlength="19" required />
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-outline form-white expiration required">
                                                <label class="form-label">Expiration Month</label>
                                                <input type="text" name="exp_month"
                                                    class="form-control form-control-lg card-expiry-month"
                                                    placeholder="MM" minlength="1" maxlength="2" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-outline form-white expiration required">
                                                <label class="form-label">Expiration Year</label>
                                                <input type="text" name="exp_year"
                                                    class="form-control form-control-lg card-exp-year"
                                                    placeholder="YYYY" minlength="4" maxlength="4" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <div class="form-outline form-white cvc required">
                                                <label class="form-label">CVV</label>
                                                <input type="password" name="cvv"
                                                    class="form-control form-control-lg card-cvc" placeholder="***"
                                                    minlength="3" maxlength="3" required />
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-2">

                                    <div class="d-flex justify-content-between font-weight-bold">
                                        <p class="mb-2">Subtotal</p>
                                        <h1 class="fa fa-dollar mb-2 font-weight-bold">
                                            {{ number_format(Cart::getTotal(), 2) }}</p>
                                            <input type="hidden" name="subTotal"
                                                value="{{ number_format(Cart::getTotal(), 2) }}">
                                    </div>
                                    <div class="d-flex justify-content-between font-weight-bold">
                                        <p class="mb-2">Shipping</p>
                                        @if(Cart::getTotal() <= "500" ) @php $shipping=0; @endphp @else @php
                                            $shipping=80; @endphp @endif <p class="fa fa-dollar mb-2 font-weight-bold">
                                            {{ number_format($shipping, 2) }}
                                            </p>
                                            <input type="hidden" name="shipping"
                                                value="{{ number_format($shipping, 2) }}">
                                    </div>
                                    <hr class="my-2 bg-dark">
                                    <div class="d-flex justify-content-between mb-4 font-weight-bold">
                                        <p class="mb-2">Total(Incl. taxes)</p>
                                        <p class="fa fa-dollar mb-2 font-weight-bold">
                                            {{ number_format(($shipping + Cart::getTotal()), 2) }}</p>
                                        <input type="hidden" name="total"
                                            value="{{ number_format(($shipping + Cart::getTotal()), 2) }}">
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary btn-block btn-lg" id="payment"
                                            onclick="order()" style="display:none;">Make Payment</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.3.min.js"
    integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous">
</script>

<script>
$(function() {
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(e.target).closest('form'),
            inputSelector = ['input[type=email]', 'input[type=password]',
                'input[type=text]', 'input[type=file]',
                'textarea'
            ].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;

        $errorMessage.addClass('d-none');
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, err) {
            var $input = $(err);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('d-none');
                e.preventDefault();
            }
        });
    });
});

$(function() {
    var $form = $("#payment-form");

    $form.on('submit', function(e) {
        if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-exp-year').val()
            }, stripeResponseHandler);
            setTimeout(function() {
                $("#cardError").hide();
            }, 8000);
        }
    });

    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('d-none')
                .find('.alert')
                .text(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            console.log(token);
            $form.get(0).submit();
        }
    }
})

function order() {

    var name = document.paymentForm.name.value;
    var email = document.paymentForm.email.value;
    var address = document.paymentForm.address.value;
    var state = document.paymentForm.state.value;
    var city = document.paymentForm.city.value;
    var zipcode = document.paymentForm.zipcode.value;
    var orderConfirm = document.getElementById('confirmOrder');
    var payemnt = document.getElementById('payment');

    if (name == "" || email == "" || address == "" || state == "" || city == "" || zipcode == "") {
        alert("All fields are required.");
        return false;
    } else if (orderConfirm.innerHTML === "Confirm Order") {
        orderConfirm.innerHTML = "Confirmed!";
        orderConfirm.style.backgroundColor = "green";
        payment.style.display = "block";
    }
}

document.getElementById('cardNumber').addEventListener("keyup", function() {
    txt = this.value;
    if (txt.length == 4 || txt.length == 9 || txt.length == 14)
        this.value = this.value + " ";
});
</script>

@endsection