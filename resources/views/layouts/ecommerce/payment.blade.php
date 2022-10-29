@extends('layouts.app')

@section('content')

<div class="container py-4">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col">
            <div class="card my-2 shadow-3">
                <div class="row">
                    <div class="col-xl-6">
                        <form action="" method="POST">
                            <div class="card-body p-md-5 text-black">
                                <h3 class="mb-4 text-uppercase">Delivery Info</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label">First name</label>
                                            <input type="text" class="form-control form-control-lg" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-outline">
                                            <label class="form-label">Last name</label>
                                            <input type="text" class="form-control form-control-lg" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control form-control-lg" />
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">State</label>
                                        <select class="select form-control form-control-lg">
                                            <option value="1">State</option>
                                            <option value="2">Option 1</option>
                                            <option value="3">Option 2</option>
                                            <option value="4">Option 3</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">City</label>
                                        <select class="select form-control form-control-lg">
                                            <option value="1">City</option>
                                            <option value="2">Option 1</option>
                                            <option value="3">Option 2</option>
                                            <option value="4">Option 3</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label">Zip</label>
                                    <input type="text" class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control form-control-lg" />
                                </div>
                                <div class="d-flex justify-content-around pt-3">
                                    <a href="{{ url('/cart')}}" class="btn btn-dark btn-lg mr-5"><i
                                            class="fa fa-arrow-left"></i> Back to Cart</a>
                                    <button type="button" class="btn btn-primary btn-lg ml-5">Place order</button>
                                </div>
                            </div>
                        </form>
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

                                <form class="mt-4">
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="typeName">Cardholder's Name</label>
                                        <input type="text" id="typeName" class="form-control form-control-lg" size="17"
                                            placeholder="Cardholder's Name" />
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="typeText">Card Number</label>
                                        <input type="text" id="typeText" class="form-control form-control-lg" size="17"
                                            placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-outline form-white">
                                                <label class="form-label" for="typeExp">Expiration</label>
                                                <input type="text" id="typeExp" class="form-control form-control-lg"
                                                    placeholder="MM/YYYY" size="7" id="exp" minlength="7"
                                                    maxlength="7" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-outline form-white">
                                                <label class="form-label" for="typeText">CVV</label>
                                                <input type="password" id="typeText"
                                                    class="form-control form-control-lg"
                                                    placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3"
                                                    maxlength="3" />
                                            </div>
                                        </div>
                                    </div>
                                </form>

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

                                <button type="button" class="btn btn-info btn-block btn-lg">
                                    <div class="d-flex justify-content-center">
                                        <span>Make Payment</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection