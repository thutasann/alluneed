<!-- Stripe Payment modal for Checkout -->
<div class='pop-up' id="testimonial">
    <div class="subcontent">
        <div class="subcontainer">

            <span class='close'>&times;</span>

            <div class='text-center'>
                <img src="{{ asset('assets/img/stripe.png')}}">
            </div>

            <div class="subscribenew">

                <h2 class='text-center'>Please Enter all of the <span>Card Information</span> and <br>
                check <span>your info</span> again before placing your order.</h2>

                <div class="cc">

                    <div class="front surface">
                        <div class="input_wrapper">
                            <div class="fullname"> </div>
                            <div class="digits"> </div>
                            <div class="expire_month"> </div>
                            <div class="expire_year"> </div>
                            <img class="method" id="visa" src="https://cdn.shopify.com/s/files/1/2499/1496/files/method-visa.png"/>
                            <img class="method" id="master" src="https://cdn.shopify.com/s/files/1/2499/1496/files/method-master.png"/>
                            <img class="method" id="ae" src="https://cdn.shopify.com/s/files/1/2499/1496/files/method-amex.png"/>
                            <img class="method" id="disc" src="https://cdn.shopify.com/s/files/1/2499/1496/files/method-discover.png"/>
                        </div>
                    </div>

                    <div class="back surface">
                        <div class="input_wrapper">
                            <div class="security"> </div>
                        </div>
                    </div>

                </div>

                <form action="{{url('/place-order-stripe')}}" method="POST" class="container require-validation" data-cc-on-file="false" id="payment-form">

                        {{ csrf_field() }}

                        <div class='form-row'>
                            <p class="stripe-error py-3 text-danger"></p>
                        </div>

                        <div class="form-row required">

                            <div class="col-6">
                                <div class="md-form form-group input-with-pre-icon">
                                    <i class="fas fa-credit-card input-prefix"></i>
                                    <input type="text" class="form-control validate card-number" name="digits" maxlength="19" required autocomplete='off' autofocus>
                                    <label>Card Number</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="md-form form-group input-with-pre-icon">
                                    <i class="fas fa-user input-prefix"></i>
                                    <input type="text" class="form-control"  name="fullname" required size="4"/>
                                    <label>Name on card</label>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="md-form form-group input-with-pre-icon">
                                    <i class="fas fa-calendar-alt input-prefix"></i>
                                    <input type="text" class="form-control validate card-expiry-month" name="expire_month" maxlength="2" required/>
                                    <label>Expiration Month</label>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="md-form form-group input-with-pre-icon">
                                    <i class="fas fa-calendar input-prefix"></i>
                                    <input class="form-control validate card-expiry-year" type="text" name="expire_year" maxlength="4" required  size="4"/>
                                    <label>Expiration Year</label>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="md-form form-group input-with-pre-icon">
                                    <i class="fas fa-shield-alt input-prefix"></i>
                                    <input class="form-control card-cvc" type="text" name="security" maxlength="3" required size="4" autocomplete="off"/>
                                    <label>CVC</label>
                                </div>
                            </div>

                        </div>

                        <!-- error handling -->
                        <div class="form-row">
                            <div class="col-md-12 form-group d-none">
                                <div class="alert-danger alert">
                                    <h6 class="inp-error">Please correct the errors and try again.</h6>
                                </div>
                            </div>
                        </div>

                        <!-- user info -->
                        <div class="row mt-5">


                            <div class="col-6">
                                <div class="form-group focused">
                                    <label class="form-control-label">First Name</label>
                                    <input type="text" name="s_fname" class="form-control form-control-alternative" placeholder="First Name"  value="{{ Auth::user()->name}}" spellcheck="false">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-control-label">Last Name</label>
                                    <input type="text" name="s_Iname" class="form-control form-control-alternative" placeholder="Last Name" value="{{ Auth::user()->Iname}}" spellcheck="false">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-control-label">Email</label>
                                    <input type="email" name="s_email" class="bg-white form-control form-control-alternative" readonly placeholder="Email Address" value="{{ Auth::user()->email}}" spellcheck="false">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group focused">
                                    <label class="form-control-label">Phone Number</label>
                                    <input type="number" name="s_phone" class="form-control form-control-alternative" placeholder="Phone Number" value="{{ Auth::user()->phone}}" spellcheck="false">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-control-label">Alternate Phone Number</label>
                                    <input type="number" name="s_alternate_phone" class="form-control form-control-alternative" placeholder="Alternate Phone Number" value="{{ Auth::user()->alternate_phone}}" spellcheck="false">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group focused">
                                    <label class="form-control-label">Address 1 (Flat No, Apt No & Address)</label>
                                    <textarea name="s_address1" rows="4" class="form-control form-control-alternative" placeholder="Address 1 (Optional)" spellcheck="false">{{ Auth::user()->address1}}
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group focused">
                                    <label class="form-control-label">Address 2 (Landmark, near by)</label>
                                    <textarea name="s_address2" rows="4" class="form-control form-control-alternative" placeholder="Address 2 (Optional)" spellcheck="false">{{ Auth::user()->address2}}
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group focused">
                                    <label class="form-control-label">City</label>
                                    <input type="text" name="s_city" class="form-control form-control-alternative" placeholder="City" value="{{ Auth::user()->city}}" spellcheck="false">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group focused">
                                    <label class="form-control-label">State</label>
                                    <input type="text" name="s_state" class="form-control form-control-alternative" placeholder="State" value="{{ Auth::user()->state}}" spellcheck="false">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-control-label">Postal code</label>
                                    <input type="number" name="s_pincode" class="form-control form-control-alternative" placeholder="Postal code" value="{{ Auth::user()->pincode}}" spellcheck="false">
                                </div>
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <hr>
                                <input type="hidden" name="stipe_payment_btn" value="1">
                                <button type="submit" class="btn bg-gradient-primary text-white btn-block">Pay Now with Stripe</button>
                            </div>
                        </div>


                </form>

            </div>

        </div>
    </div>
</div>
