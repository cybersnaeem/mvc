
<form  action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post" id="formPayment">

        <?php $payment = $this->getPayment(); ?>
    <div class="container">
        <div class="card text-left">
          <img class="card-img-top" src="holder.js/100px180/" alt="">
          <div class="card-body">
            <h4 class="card-title">
            <?php if($this->getRequest()->getGet('id')) :?>
        <p class="h2 text-center">Update Payment Details</p><br>
        <?php else: ?>
            <p class="h2 text-center">Add Payment Details</p><br>
        <?php endif;?>
            </h4>
            <p class="card-text">
            <div class="row">
                <div class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                    <input id="productname" name="payment[name]" value="<?php echo $payment->name ?>" type="text" class="validate">
                    <label for="productname">Name</label>
                    </div>
                    <div class="input-field col s6">
                    <input id="productname" name="payment[code]" value="<?php echo $payment->code ?>" type="text" class="validate">
                    <label for="productname">Code</label>
                    </div>
                </div>
                <div class="row">
                        <div class="input-field col s12">
                        <textarea id="desc" name="payment[description]" class="materialize-textarea"><?php echo $payment->description ?></textarea>
                        <label for="desc">Description</label>
                        </div>
                </div>
                <div class="row">
                   <div class="input-field col s6">
                    <input id="productname" name="payment[amount]" value="<?php echo $payment->amount ?>" type="text" class="validate">
                    <label for="productname">Amount</label>
                    </div>
                        <div class="input-field col s6">
                        <div class="switch">
                            <label>
                            Disabled
                            <?php if($payment->status):
                                    $label = 'checked'; 
                                else:
                                        $label = '!checked';  
                                endif;
                                ?>
                            <input name='payment[status]' type='checkbox' <?php echo $label; ?>> 
                            <span class="lever"></span>
                            Enabled
                            </label>
                        </div>
                        </div>
                </div>
                
                <?php if(!$this->getRequest()->getGet('id')) :?>
                <button class="btn waves-effect waves-light" type="button" onclick="mage.resetParam().setForm('#formPayment').load();" name="add">Add Payment
                    <i class="material-icons right">add</i>
                </button>
                <?php else: ?>
                  <button class="btn waves-effect waves-light" type="button" onclick="mage.resetParam().setForm('#formPayment').load();" name="add">Update Payment
                    <i class="material-icons right">edit</i>
                </button>
                <?php endif; ?>
                <button class="btn waves-effect waves-light" type="button" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid', null, null, true); ?>').load()" name="cancel">Cancel
                    <i class="material-icons right">close</i>
                </button>
                </div>
            </div>  
            </p>
          </div>
        </div>
    </div>
    </form>