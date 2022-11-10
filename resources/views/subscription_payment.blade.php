@extends('layouts.app')

@section('content')
    <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
    <div class='error form-group d-none'>
        <div class='alert alert-danger' id='cardError'></div>
    </div>
    <form name="paymentForm" role="form" action="{{ route('subscribed') }}" method="POST" class="require-validation"
        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_PUBLISHED_KEY') }}" id="payment-form">
        @csrf
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-5 py-5 d-flex">
                <div class="card bg-light text-white border border-dark  w-75">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="mb-0">Card details</h2>
                        </div>
                        <p class="medium mb-1 font-weight-bold">Card type</p>
                        <img class="ml-2" width="45px" src="https://cdn-icons-png.flaticon.com/512/349/349221.png"
                            alt="Visa" />
                        <img class="ml-2" width="45px" src="https://cdn-icons-png.flaticon.com/512/349/349228.png"
                            alt="AmericanExpress" />
                        <img class="ml-2" width="45px" src="https://cdn-icons-png.flaticon.com/128/5968/5968382.png"
                            alt="Stripe" />
                        {{-- <img class="ml-2" width="45px" src="https://cdn-icons-png.flaticon.com/128/825/825464.png" alt="Mastercard" /> --}}
                        <img class="ml-2" width="45px" src="https://cdn-icons-png.flaticon.com/128/1440/1440517.png"
                            alt="PayPal" />
                        {{-- <img class="ml-2" width="45px" src="https://cdn-icons-png.flaticon.com/128/349/349230.png" alt="Discovery" /> --}}

                        <div class="form-outline form-white mt-2 required">
                            <label class="form-label">Cardholder's Name</label>
                            <input type="text" name="cardName" class="form-control form-control-lg"
                                placeholder="Cardholder's Name" required />
                        </div>
                        <div class="form-outline form-white mt-2">
                            <label class="form-label">Card Number</label>
                            <input type="text" name="cardNumber" id="cardNumber"
                                class="form-control form-control-lg card-number" placeholder="1234 5678 9012 3457"
                                maxlength="19" required />
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form-outline form-white expiration required">
                                    <label class="form-label">Expiration Month</label>
                                    <input type="text" name="exp_month"
                                        class="form-control form-control-lg card-expiry-month" placeholder="MM"
                                        minlength="1" maxlength="2" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-outline form-white expiration required">
                                    <label class="form-label">Expiration Year</label>
                                    <input type="text" name="exp_year" class="form-control form-control-lg card-exp-year"
                                        placeholder="YYYY" minlength="4" maxlength="4" required />
                                </div>
                            </div>
                            <div class="col-md-3 mt-2">
                                <div class="form-outline form-white cvc required">
                                    <label class="form-label">CVV</label>
                                    <input type="password" name="cvv" class="form-control form-control-lg card-cvc"
                                        placeholder="***" minlength="3" maxlength="3" required />
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 bg-dark">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary btn-block btn-lg w-75" id="payment">
                                <b>Make Payment<span> (${{ $amount }})</span></b></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-1.12.3.min.js"
        integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script>

    <script>
        document.getElementById('cardNumber').addEventListener("keyup", function() {
            txt = this.value;
            if (txt.length == 4 || txt.length == 9 || txt.length == 14)
                this.value = this.value + " ";
        });

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
        });
    </script>
@endsection
