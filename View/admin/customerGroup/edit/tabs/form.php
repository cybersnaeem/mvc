
<form action="<?php echo $this->getUrl()->getUrl('save');?>" method="post" id="formCGroup">
    <?php $customerGroup = $this->getCustomerGroup();
    ?>
    <div class="container">
        <div class="card text-left">
          <div class="card-body">
            <h4 class="card-title">
            <?php if($this->getRequest()->getGet('id')) :?>
              <p class="h2 text-center">Update Customer Group Details</p><br>
          <?php else: ?>
              <p class="h2 text-center">Add Customer Group Details</p><br>
          <?php endif;?>
            </h4>
            <p class="card-text">
            <div class="row">
                <div class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                    <input id="categoryname" name="customerGroup[name]" value="<?php echo $customerGroup->name ?>" type="text" class="validate">
                    <label for="categoryname">Group Name</label>
                    </div>
                    <div class="input-field col s6">
                    <div class="switch">
                            <label>
                            Disabled
                            <?php if($customerGroup->status):
                                      $label = 'checked'; 
                                  else:
                                        $label = '!checked';  
                                  endif;
                                ?>
                            <input name='customerGroup[status]' type='checkbox' <?php echo $label; ?>> 
                            <span class="lever"></span>
                            Enabled
                            </label>
                        </div>
                    </div>
                </div>
                <?php if(!$this->getRequest()->getGet('id')) :?>
                <button class="btn waves-effect waves-light" type="button" onclick="mage.resetParam().setForm('#formCGroup').load();" name="add">Add Customer Group
                    <i class="material-icons right">add</i>
                </button>
                <?php else: ?>
                  <button class="btn waves-effect waves-light" type="button" onclick="mage.resetParam().setForm('#formCGroup').load();" name="add">Update Customer Group
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
