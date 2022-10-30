@extends('layouts.app')

@section('content')

<div class="container py-4">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col">
            <div class="card my-2 shadow-3">
                <form name="orderForm" action="/cart">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card-body p-md-5 text-black">
                                <h3 class="mb-4 text-uppercase">Delivery Info</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label">First name</label>
                                            <input type="text" name="fname" class="form-control form-control-lg"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label">Last name</label>
                                            <input type="text" name="lname" class="form-control form-control-lg"
                                                required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control form-control-lg" required />
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
                                <div class="form-outline mb-4">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control form-control-lg" required />
                                </div>
                                <div class="d-flex justify-content-around pt-3">
                                    <a href="{{ url('/cart')}}" class="btn btn-dark btn-lg mr-5"><i
                                            class="fa fa-arrow-left"></i> Back to Cart</a>
                                    <button type="submit" class="btn btn-primary btn-lg ml-5" onclick="order()"
                                        id="confirm">Confirm Order</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5 mt-4 ml-4">
                            <div class="card bg-primary text-white rounded-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h2 class="mb-0">Card details</h2>
                                    </div>

                                    <p class="medium mb-2">Card type</p>
                                    <i class="fa fa-cc-mastercard fa-3x"></i>
                                    <i class="fa fa-cc-visa fa-3x"></i>
                                    <i class="fa fa-cc-amex fa-3x"></i>
                                    <i class="fa fa-cc-paypal fa-3x"></i>

                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label">Cardholder's Name</label>
                                        <input type="text" name="cardName" class="form-control form-control-lg"
                                            placeholder="Cardholder's Name" required />
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label">Card Number</label>
                                        <input type="text" name="cardNumber" class="form-control form-control-lg"
                                            placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" required />
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-outline form-white">
                                                <label class="form-label">Expiration Date</label>
                                                <input type="text" name="exp" class="form-control form-control-lg"
                                                    placeholder="MM/YYYY" minlength="7" maxlength="7" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-outline form-white">
                                                <label class="form-label">CVV</label>
                                                <input type="password" name="cvv" class="form-control form-control-lg"
                                                    placeholder="***" minlength="3" maxlength="3" required />
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-2">

                                    <div class="d-flex justify-content-between">
                                        <p class="mb-2">Subtotal</p>
                                        <p class="mb-2"><i class="fa fa-rupee"></i> {{ Cart::getSubTotal() }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-2">Shipping</p>
                                        <p class="mb-2"><i class="fa fa-rupee"></i> 50.00</p>
                                    </div>
                                    <div class="d-flex justify-content-between mb-4">
                                        <p class="mb-2">Total(Incl. taxes)</p>
                                        <p class="mb-2"><i class="fa fa-rupee"></i> {{ Cart::getTotal() }}</p>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-info btn-block btn-lg" id="payment"
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

<script>
function order() {
    var fname = document.orderForm.fname.value;
    var lname = document.orderForm.lname.value;
    var email = document.orderForm.email.value;
    var state = document.orderForm.state.value;
    var city = document.orderForm.city.value;
    var zipcode = document.orderForm.zipcode.value;
    var address = document.orderForm.address.value;
    var order = document.getElementById('confirm');
    var payemnt = document.getElementById('payment');
    if (fname == "" || lname == "" || email == "" || state == "" || city == "" || zipcode == "" || address == "") {
        alert("All fields are required.");
        return false;
    } else if (order.innerHTML === "Confirm Order") {
        order.innerHTML = "Confirmed!";
        order.style.backgroundColor = "green";
        payment.style.display = "block";
    }
}
</script>

@endsection