
<form  action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post" id="formShip">
<?php $shipment =$this->getShipment(); ?>
    <div class="container">
        <div class="card text-left">
          <div class="card-body">
            <h4 class="card-title">
            <?php if($this->getRequest()->getGet('id')) :?>
              <p class="h2 text-center">Update Shipment Details</p><br>
          <?php else: ?>
              <p class="h2 text-center">Add Shipment Details</p><br>
          <?php endif;?>
            </h4>
            <p class="card-text">
            <div class="row">
                <div class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                    <input id="productname" name="shipment[name]" value="<?php echo $shipment->name ?>" type="text" class="validate">
                    <label for="productname">Name</label>
                    </div>
                    <div class="input-field col s6">
                    <input id="productname" name="shipment[code]" value="<?php echo $shipment->code ?>" type="text" class="validate">
                    <label for="productname">Code</label>
                    </div>
                </div>
                <div class="row">
                        <div class="input-field col s12">
                        <textarea id="desc" name="shipment[description]" class="materialize-textarea"><?php echo $shipment->description ?></textarea>
                        <label for="desc">Description</label>
                        </div>
                </div>
                <div class="row">
                  <div class="input-field col s6">
                    <input id="productname" name="shipment[amount]" value="<?php echo $shipment->amount ?>"  type="text" class="validate">
                    <label for="productname">Amount</label>
                    </div>
                        <div class="input-field col s12">
                        <div class="switch">
                            <label>
                            Disabled
                            <?php if($shipment->status):
                                    $label = 'checked'; 
                                  else:
                                        $label = '!checked';  
                                  endif;
                                ?>
                            <input name='shipment[status]' type='checkbox' <?php echo $label; ?>> 
                            <span class="lever"></span>
                            Enabled
                            </label>
                        </div>
                        </div>
                </div>
                
                <?php if(!$this->getRequest()->getGet('id')) :?>
                <button class="btn waves-effect waves-light" type="button" onclick="mage.resetParam().setForm('#formShip').load();" name="add">Add Shipment
                    <i class="material-icons right">add</i>
                </button>
                <?php else: ?>
                  <button class="btn waves-effect waves-light" onclick="mage.resetParam().setForm('#formShip').load();" type="button" name="add">Update Shipment
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