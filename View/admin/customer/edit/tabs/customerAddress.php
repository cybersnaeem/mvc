<form action="<?php echo $this->getUrl()->getUrl('address','admin\customer'); ?>" method="post" id="addressform">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6">
            <?php  
                    $id = $this->getRequest()->getGet('id');
                    $billingData = $this->getAddressData($id,'Billing');
                    $shippingData = $this->getAddressData($id,'Shipping');
            ?>   
            <div class="card text-left">
            <div class="card-body">
                <h4 class="card-title">
                <p class="h2 text-center">Billing Address</p><br>
                </h4>
                <p class="card-text">
                
                <div class="row">
                        <div class="input-field col s6">
                                <input id="address" name="billing[address]" value="<?php echo $billingData->address ?>"  type="text" class="validate">
                                <label for="address">Address</label>
                        </div>
                </div>
                <div class="row">
                    <div class="col s12">
                    <div class="row">
                    <div class="input-field col s6">
                        <select class="browser-default" name="billing[city]">
                            <option value="<?php echo $billingData->city ?>" selected><?php echo $billingData->city ?></option>
                            <option value="Vapi">Vapi</option>
                            <option value="Surat">Surat</option>
                            <option value="Delhi">Delhi</option>
                        </select>
                        </div>
                        <div class="input-field col s6">
                        <select class="browser-default" name="billing[state]">
                            <option value="<?php echo $billingData->state ?>" selected><?php echo $billingData->state ?></option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Punjab">Punjab</option>
                        </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                        <input id="zip" name="billing[zipCode]" class="validate" value="<?php echo $billingData->zipCode ?>">
                        <label for="zip">Zipcode</label>
                        </div>
                        <div class="input-field col s6">
                        <select class="browser-default" name="billing[country]">
                            <option value="<?php echo $billingData->country ?>" selected><?php echo $billingData->country ?></option>
                            <option value="India">India</option>
                            <option value="Australia">Australia</option>
                            <option value="Brazil">Brazil</option>
                        </select>
                        </div>
                        
                    </div>
                    </div>
                    
                    </div>
                    
                    </div>
                </div>  
            </p>
          </div>
          <div class="col-lg-6 col-md-6">
                
            <div class="card text-left">
            <div class="card-body">
                <h4 class="card-title">
                <p class="h2 text-center">Shipping Address</p><br>
                </h4>
                <p class="card-text">
                
                <div class="row">
                        <div class="input-field col s6">
                                <input id="contact" name="shipping[address]" value="<?php echo $shippingData->address ?>"  type="text" class="validate">
                                <label for="contact">Address</label>
                        </div>
                </div>
                <div class="row">
                    <div class="col s12">
                    <div class="row">
                        <div class="input-field col s6">
                        <select class="browser-default" name="shipping[city]">
                            <option value="<?php echo $shippingData->city ?>" selected><?php echo $shippingData->city ?></option>
                            <option value="Vapi">Vapi</option>
                            <option value="Surat">Surat</option>
                            <option value="Delhi">Delhi</option>
                        </select>
                        </div>
                        <div class="input-field col s6">
                        <select class="browser-default" name="shipping[state]">
                            <option value="<?php echo $shippingData->state ?>" selected><?php echo $shippingData->state ?></option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Punjab">Punjab</option>
                        </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                        <input id="zipcode" name="shipping[zipCode]" class="validate" value="<?php echo $shippingData->zipCode ?>" >
                        <label for="zipcode">Zipcode</label>
                        </div>
                        <div class="input-field col s6">
                        <select class="browser-default" name="shipping[country]">
                            <option value="<?php echo $shippingData->country ?>" selected><?php echo $shippingData->country ?></option>
                            <option value="India">India</option>
                            <option value="Australia">Australia</option>
                            <option value="Brazil">Brazil</option>
                        </select>
                        </div>
                        
                    </div>
                    </div>
                    
                    </div>
                    </div>
                </div>  
            </p>
          </div>
        </div>
        <div class="text-center">
        <button class="btn waves-effect waves-light" type="button" onclick="mage.resetParam().setForm('#addressform').load();" name="add">Save
            <i class="material-icons right">add</i>
        </button>
        <button class="btn waves-effect waves-light" type="button" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('address', null, null, true); ?>').load()" name="cancel">Cancel
            <i class="material-icons right">close</i>
        </button>
        </div>
                    
    </div>  
    </div>
    </div>
    
    </form>

