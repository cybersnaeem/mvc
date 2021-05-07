<?php
    //$items = $this->getCart()->getItems()->getData();
    $customer = $this->getCart()->getCustomer();
    $cartBillingAddress = $this->getBillingAddress();
    $cartShippingAddress = $this->getShippingAddress();     
    $cart = $this->getCart();
?>

 <!-- Cart view section -->
 <section id="checkout">
 <form action="<?php echo $this->getUrl()->getUrl('save','admin\cart')?>" method="POST" id="checkoutform">
   <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="card text-left">
                  <div class="card-body">
                    <h4 class="card-title"><strong>Billing Address</strong></h4>
                    <p class="card-text">
                            <table class="table">
                            <tr>
                                    <td colspan="2">
                                        <p>
                                            Cart Billing Address Place Here..
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="billing[address]" id="address" value="<?php echo $cartBillingAddress->address?>"
                                            placeholder="Address" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="billing[city]" id="lastname" value="<?php echo $cartBillingAddress->city?>"
                                            placeholder="City" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="billing[state]" id="state" value="<?php echo $cartBillingAddress->state?>"
                                            placeholder="State" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="billing[zipCode]" id="zipcode" value="<?php echo $cartBillingAddress->zipCode ?>"
                                            placeholder="Zipcode" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <input type="text" name="billing[country]" id="country" value="<?php echo $cartBillingAddress->country?>"
                                            placeholder="Country" class="form-control">
                                    </td>
                                    <td>
                                            <?php 
                                                if($cartBillingAddress->sameAsBilling):
                                                    $label = 'checked'; 
                                                else:
                                                        $label = '!checked';  
                                                endif;
                                            ?>
                                        <p>
                                            <label>
                                                <input type="checkbox" class="filled-in" name="billingSaveAddressBook" <?php $label ?>/>
                                                <span>Save to Address book :</span>
                                            </label>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        
                                    </td>
                                </tr>
                        </table>
                    </p>
                  </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
            
                <div class="card text-left">
                  <div class="card-body">
                  <h4 class="card-title"><strong>Shipping Address</strong></h4>
                    <p class="card-text">
                            <table class="table">
                                <tr>
                                    <td colspan="2">
                                    <p>
                                        <label>
                                            <input type="checkbox" class="filled-in" name="shipping[sameAsBilling]" id="sameasbilling" onclick="myCheckbox();" <?php if ($cartBillingAddress->sameAsBilling){echo "Checked";}?>/>
                                            <span>Same as Billing Address :</span>
                                        </label>
                                    </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="shipping[address]" id="shippingAddress" value="<?php echo $cartShippingAddress->address;?>"
                                            placeholder="Address" class="form-control" <?php if ($cartBillingAddress->sameAsBilling){echo "Disabled";}?>>
                                    </td>
                                    <td>
                                        <input type="text" name="shipping[city]" id="shippingCity" value="<?php echo $cartShippingAddress->city;?>"
                                            placeholder="City" class="form-control" <?php if ($cartBillingAddress->sameAsBilling){echo "Disabled";}?>>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="shipping[state]" id="shippingState" value="<?php echo $cartShippingAddress->state;?>"
                                            placeholder="State" class="form-control" <?php if ($cartBillingAddress->sameAsBilling){echo "Disabled";}?>>
                                    </td>
                                    <td>
                                        <input type="text" name="shipping[zipCode]" id="shippingZipcode" value="<?php echo $cartShippingAddress->zipCode;?>"
                                            placeholder="Zipcode" class="form-control" <?php if ($cartBillingAddress->sameAsBilling){echo "Disabled";}?>>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <input type="text" name="shipping[country]" id="shippingCountry" value="<?php echo $cartShippingAddress->country; ?>"
                                            placeholder="Country" class="form-control" <?php if ($cartBillingAddress->sameAsBilling){echo "Disabled";}?>>
                                    </td>
                                    <td>
                                        <p>
                                            <label>
                                                <input type="checkbox" id="shippingSaveAddressBook" name="shippingSaveAddressBook" <?php if ($cartBillingAddress->sameAsBilling){echo "Disabled";}?> class="filled-in" />
                                                <span>Save to Address book:</span>
                                            </label>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                   
                                    </div>
                                </tr>
                            </table>
                            </p>
                        </div>
                        </div>
                    </div>
                </div>
             </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="card text-left">
                      <div class="card-body">
                        <h4 class="card-title">Payment Method</h4>
                        <p class="card-text">
                            <?php $payments = $this->getPaymentMethod();
                              foreach ($payments as $key => $payment):
                            ?>
                                <p>
                                    <label>
                                        <input class="with-gap" name="cart[paymentMethodId]" type="radio" value="<?php echo $payment->methodId ?>" <?php if($cart->paymentMethodId == $payment->methodId){ echo "checked"; } ?>/>
                                        <span><?php echo $payment->name ?></span>
                                    </label>
                                </p>
                            <?php endforeach; ?>
                            
                        </p>
                      </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="card text-left">
                      <div class="card-body">
                        <h4 class="card-title">Shipping Method</h4>
                        <p class="card-text">
                        <?php $shippings = $this->getShippingMethod();
                              foreach ($shippings as $key => $shipping):
                            ?>
                                <p>
                                    <label>
                                        <input class="with-gap" name="cart[shippingMethodId]" type="radio" value="<?php echo $shipping->methodId ?>" <?php if($cart->shippingMethodId == $shipping->methodId){ echo "checked"; } ?>/>
                                        <span><?php echo $shipping->name ?></span>
                                    </label>
                                </p>
                            <?php endforeach; ?>
                        </p>
                      </div>
                    </div>
                </div>      
                <div>
                </div>
                                           
            </div>
            <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card text-center">
                      <div class="card-body">
                        <p class="card-text">
                        <input type="button" onclick="mage.resetParam().setForm('#checkoutform').load();" value="Save" class="btn btn-danger btn-lg">
                        <a href="javascript:void(0);" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin\cart',['id'=>null],true);?>').resetParam().load();" 
                        name="cancel" class="btn btn-danger btn-lg">Cancel</a>
                        <a href="javascript:void(0);" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('placeOrder','admin\OrderDetails',['id'=>null],true);?>').resetParam().load();"
                        name="cancel" class="btn btn-danger btn-lg">PlaceOrder</a>
                        </p>
                      </div>
                    </div>
                    </div>
                </div>                                    
            </div>
          </div>
        </div>
    </form> 
 </section>
 <!--  Cart view section -->
 <script>
        function myCheckbox() {
            var sameasbilling = document.getElementById("sameasbilling");
            if (sameasbilling.checked == true) {
                document.getElementById("shippingAddress").disabled = true;
                document.getElementById("shippingCity").disabled = true;
                document.getElementById("shippingState").disabled = true;
                document.getElementById("shippingZipcode").disabled = true;
                document.getElementById("shippingCountry").disabled = true;
                document.getElementById("shippingSaveAddressBook").disabled = true;

                

            }else{
                document.getElementById("shippingAddress").disabled = false;
                document.getElementById("shippingCity").disabled = false;
                document.getElementById("shippingState").disabled = false;
                document.getElementById("shippingZipcode").disabled = false;
                document.getElementById("shippingCountry").disabled = false; 
                document.getElementById("shippingSaveAddressBook").disabled = false;
           
            }
        }


</script>     
                   