<?php

$cart = $this->getCart();


$items = $cart->getItems()->getData();

$customer = $cart->getCustomer();

$cartBillingAddress = $this->getBillingAddress();


if ($cartBillingAddress->sameAsBilling) {
    $cartShippingAddress = $this->getBillingAddress();
} else {
    $cartShippingAddress = $this->getShippingAddress();
}

?>

<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="panel-group checkout-steps" id="accordion">

                        <div class="panel panel-default checkout-step-01">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                                        <span>1</span>Cart Summery
                                    </a>
                                </h4>
                            </div>

                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="row">
                                        <form action="<?php echo $this->getUrl()->getUrl('save', 'admin\cart'); ?>" method="POST" class="register-form" role="form">

                                            <!-- guest-login -->
                                            <div class="col-md-12 col-sm-12">
                                                <!-- <h4 class="checkout-subtitle">Items</h4> -->
                                                <!-- <p class="text title-tag-line">Register with us for future convenience:</p> -->
                                                <div class="col-md-12 col-sm-12 already-registered-login right">
                                                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button checkout-continue ">Continue</button>
                                                </div>
                                                <div class="form-group">
                                                    <?php foreach ($this->getShippingMethods()->getData() as $shipping) : ?>
                                                        <div class="col-md-12 col-sm-12 ">
                                                            <input id="shippingMethod<?php echo $shipping->shippingId; ?>" type="radio" name="cart[shippingMethodId]" value="<?php echo $shipping->shippingId; ?>" <?php echo ($shipping->shippingId == $cart->shippingMethodId) ? "checked" : ""; ?>>
                                                            <label class="radio-button " for="shippingMethod<?php echo $shipping->shippingId; ?>"><?php echo $shipping->name; ?></label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>

                                            </div>

                                        </form>
                                        <!-- already-registered-login -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default checkout-step-02">
                            <!-- panel-heading -->
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
                                        <span>2</span>Shipping & Billing Address
                                    </a>
                                </h4>
                            </div>
                            <!-- panel-heading -->

                            <div id="collapseTwo" class="panel-collapse collapse ">
                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">
                                        <form class="register-form" action="<?php echo $this->getUrl()->getUrl('save', 'home\home') ?>" role="form" method="POST">
                                            <!-- already-registered-login -->

                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <h4 class="checkout-subtitle">Billing Address</h4>
                                                <!-- <p class="text title-tag-line">Please log in below:</p> -->

                                                <div class="form-group radio  col-md-12 col-sm-12">
                                                    <?php
                                                    //<input type="checkbox" onclick="myCheckbox();" class=" radio-checkout-unicase" value="1" name="shipping[sameasbilling]" id="sameasbilling">
                                                    ?>
                                                    <label class="info-title" for="sameasbilling"></label>
                                                </div>

                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label class="info-title" for="billingAddress">Address<span>*</span></label>
                                                    <input type="text" class="form-control unicase-form-control text-input" name="billing[address]" id="billingAddress" placeholder="ADDRESS" value="<?php echo $cartBillingAddress->address; ?>">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label class="info-title" for="billingCountry">Country<span>*</span></label>
                                                    <select name="billing[country]" id="billingCountry" class="form-control unicase-form-control text-input">
                                                        <option value="" selected disabled>Select Country</option>
                                                        <?php foreach ($this->getCountries() as $value) : ?>
                                                            <option value="<?php echo $value; ?>" <?php echo ($cartBillingAddress->country == $value) ? "selected" : ""; ?>><?php echo $value; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label class="info-title" for="billingState">State<span>*</span></label>
                                                    <select name="billing[state]" id="billingState" class="form-control unicase-form-control text-input">
                                                        <option value="" selected disabled>Select State</option>
                                                        <?php foreach ($this->getStates() as $value) : ?>
                                                            <option value="<?php echo $value; ?>" <?php echo ($cartBillingAddress->state == $value) ? "selected" : ""; ?>><?php echo $value; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label class="info-title" for="billingCity">City<span>*</span></label>
                                                    <select name="billing[city]" id="billingCity" class="form-control unicase-form-control text-input">
                                                        <option value="" selected disabled>Select City</option>
                                                        <?php foreach ($this->getCities() as $value) : ?>
                                                            <option value="<?php echo $value; ?>" <?php echo ($cartBillingAddress->city == $value) ? "selected" : ""; ?>><?php echo $value; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label class="info-title" for="billingZipcode">Zipcode<span>*</span></label>
                                                    <input type="text" name="billing[zipCode]" id="billingZipcode" class="form-control unicase-form-control text-input" value="<?php echo $cartShippingAddress->zipCode; ?>">
                                                </div>


                                                <div class="form-group radio  col-md-12 col-sm-12">
                                                    <input type="checkbox" class="radio-checkout-unicase" value="1" name="billingSaveAddressBook" id="billingSaveAddressBook">
                                                    <label class="info-title" for="billingSaveAddressBook">Save To Address Book</label>
                                                </div>


                                            </div>

                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <h4 class="checkout-subtitle">Shipping Address</h4>
                                                <!-- <p class="text title-tag-line">Please log in below:</p> -->

                                                <div class="form-group radio  col-md-12 col-sm-12">
                                                    <input type="checkbox" onclick="myCheckbox();" class=" radio-checkout-unicase" value="1" name="shipping[sameAsBilling]" id="sameasbilling" <?php echo ($cartBillingAddress->sameAsBilling) ? "checked" : ""; ?>>
                                                    <label class="info-title" for="sameAsBilling">Same As Billing</label>
                                                </div>

                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label class="info-title" for="shippingAddress">Address<span>*</span></label>
                                                    <input type="text" class="form-control unicase-form-control text-input" name="shipping[address]" id="shippingAddress" placeholder="ADDRESS" value="<?php echo $cartShippingAddress->address; ?>">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label class="info-title" for="shippingCountry">Country<span>*</span></label>
                                                    <select name="shipping[country]" id="shippingCountry" class="form-control unicase-form-control text-input">
                                                        <option value="" selected disabled>Select Country</option>
                                                        <?php foreach ($this->getCountries() as $value) : ?>
                                                            <option value="<?php echo $value; ?>" <?php echo ($cartShippingAddress->country == $value) ? "selected" : ""; ?>><?php echo $value; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label class="info-title" for="shippingState">State<span>*</span></label>
                                                    <select name="shipping[state]" id="shippingState" class="form-control unicase-form-control text-input">
                                                        <option value="" selected disabled>Select State</option>
                                                        <?php foreach ($this->getStates() as $value) : ?>
                                                            <option value="<?php echo $value; ?>" <?php echo ($cartShippingAddress->state == $value) ? "selected" : ""; ?>><?php echo $value; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label class="info-title" for="shippingCity">City<span>*</span></label>
                                                    <select name="shipping[city]" id="shippingCity" class="form-control unicase-form-control text-input">
                                                        <option value="" selected disabled>Select City</option>
                                                        <?php foreach ($this->getCities() as $value) : ?>
                                                            <option value="<?php echo $value; ?>" <?php echo ($cartShippingAddress->city == $value) ? "selected" : ""; ?>><?php echo $value; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label class="info-title" for="shippingZipcode">Zipcode<span>*</span></label>
                                                    <input type="text" name="shipping[zipCode]" id="shippingZipcode" class="form-control unicase-form-control text-input" value="<?php echo $cartShippingAddress->zipCode; ?>">
                                                </div>

                                                <div class="form-group radio  col-md-12 col-sm-12">
                                                    <input type="checkbox" class="radio-checkout-unicase" value="1" name="shippingSaveAddressBook" id="shippingSaveAddressBook">
                                                    <label class="info-title" for="shippingSaveAddressBook">Save To Address Book</label>
                                                </div>

                                            </div>

                                            <div class="col-md-12 col-sm-12 already-registered-login">
                                                <div class="form-group">
                                                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Save</button>
                                                </div>
                                            </div>

                                        </form>
                                        <!-- already-registered-login -->

                                    </div>
                                </div>
                                <!-- panel-body  -->

                            </div>
                            <!-- row -->
                        </div>

                        <div class="panel panel-default checkout-step-03">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseThree">
                                        <span>3</span>Payment & Shipping Information
                                    </a>
                                </h4>
                            </div>

                            <div id="collapseThree" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <form action="<?php echo $this->getUrl()->getUrl('save', 'home\home'); ?>" method="POST" class="register-form" role="form">

                                            <!-- guest-login -->
                                            <div class="col-md-6 col-sm-6 guest-login">
                                                <h4 class="checkout-subtitle">Shipping Methods</h4>
                                                <!-- <p class="text title-tag-line">Register with us for future convenience:</p> -->


                                                <div class="form-group">
                                                    <?php foreach ($this->getShippingMethods()->getData() as $shipping) : ?>
                                                        <div class="col-md-12 col-sm-12 ">
                                                            <input id="shippingMethod<?php echo $shipping->methodId; ?>" type="radio" name="cart[shippingMethodId]" value="<?php echo $shipping->methodId; ?>" <?php echo ($shipping->methodId == $cart->shippingMethodId) ? "checked" : ""; ?>>
                                                            <label class="radio-button " for="shippingMethod<?php echo $shipping->methodId; ?>"><?php echo $shipping->name; ?></label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>


                                            </div>
                                            <!-- guest-login -->

                                            <!-- already-registered-login -->
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <h4 class="checkout-subtitle">Payment Methods</h4>
                                                <!-- <p class="text title-tag-line">Please log in below:</p> -->

                                                <div class="form-group">
                                                    <?php foreach ($this->getPaymentMethods()->getData() as $payment) : ?>
                                                        <div class="col-md-12 col-sm-12 ">
                                                            <input id="paymentMethod<?php echo $payment->methodId; ?>" type="radio" name="cart[paymentMethodId]" value="<?php echo $payment->methodId; ?>" <?php echo ($payment->methodId == $cart->paymentMethodId) ? "checked" : ""; ?>>
                                                            <label class="radio-button " for="paymentMethod<?php echo $payment->methodId; ?>"><?php echo $payment->name; ?></label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 already-registered-login">
                                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button checkout-continue ">Continue</button>
                                            </div>
                                        </form>
                                        <!-- already-registered-login -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default checkout-step-03">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseFour">
                                        <span>4</span>Place Order
                                    </a>
                                </h4>
                            </div>

                            <div id="collapseFour" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <!-- already-registered-login -->
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <h4 class="checkout-subtitle">Place Order</h4>
                                            <!-- <p class="text title-tag-line">Please log in below:</p> -->

                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 ">
                                                    <a href="<?php echo $this->getUrl()->getUrl('placeOrder', 'home\home'); ?>" class="btn-upper btn btn-primary checkout-page-button checkout-continue">Place Order</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    if (document.getElementById("sameasbilling").checked) {
        myCheckbox();
    }

    function myCheckbox() {
        var sameasbilling = document.getElementById("sameasbilling");

        //document.getElementById("shippingCountry").disabled = true;

        if (sameasbilling.checked == true) {
            document.getElementById("shippingAddress").disabled = true;
            document.getElementById("shippingCity").disabled = true;
            document.getElementById("shippingState").disabled = true;
            document.getElementById("shippingZipcode").disabled = true;
            document.getElementById("shippingCountry").disabled = true;

            document.getElementById("shippingAddress").value = "";
            document.getElementById("shippingCity").selectedIndex = "";
            document.getElementById("shippingState").selectedIndex = "";
            document.getElementById("shippingCountry").selectedIndex = "";
            document.getElementById("shippingZipcode").value = "";

        } else {
            document.getElementById("shippingAddress").disabled = false;
            document.getElementById("shippingCity").disabled = false;
            document.getElementById("shippingState").disabled = false;
            document.getElementById("shippingCountry").disabled = false;
            document.getElementById("shippingZipcode").disabled = false;
        }
    }
</script>