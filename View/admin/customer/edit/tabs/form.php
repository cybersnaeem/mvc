
    <form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post" id="formCustomer">
        <?php $customer = $this->getCustomer(); ?>
        <div class="container">
        <div class="card text-left">
          <div class="card-body">
            <h4 class="card-title">
            <?php if($this->getRequest()->getGet('id')) :?>
        <p class="h2 text-center">Update Customer Details</p><br>
        <?php else: ?>
            <p class="h2 text-center">Add Customer Details</p><br>
        <?php endif;?>
            </h4>
            <p class="card-text">
            <div class="row">
                <div class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                    <input id="fname" name="customer[firstName]" value="<?php echo $customer->firstName ?>" type="text" class="validate">
                    <label for="fname">First Name</label>
                    </div>
                    <div class="input-field col s6">
                    <input id="lname" name="customer[lastName]" value="<?php echo $customer->lastName ?>" type="text" class="validate">
                    <label for="lname">Last Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                    <input id="email" name="customer[email]" value="<?php echo $customer->email ?>" type="email" class="validate">
                    <label for="email">Email</label>
                    </div>
                    <div class="input-field col s6">
                    <input id="pass" name="customer[password]" value="<?php echo $customer->password ?>" type="password" class="validate">
                    <label for="pass">Password</label>
                    </div>
                    
                </div>
                <div class="row">
                        <div class="input-field col s6">
                            <input id="contact" name="customer[contactNo]" value="<?php echo $customer->contactNo ?>" type="text" maxlegth="10" class="validate">
                            <label for="contact">Contact No</label>
                        </div>
                        <div class="input-field col s6">
                        <div class="switch">
                            <label> 
                            Disabled
                            <?php if($customer->status):
                                    $label = 'checked'; 
                                  else:
                                        $label = '!checked';  
                                  endif;
                                ?>
                            <input name='customer[status]' type='checkbox' <?php echo $label; ?>> 
                            <span class="lever"></span>
                            Enabled
                            </label>
                        </div>
                        </div>
                </div>
                
                <div class="row">
                    <div class="input-field col s12">
                    <select class="browser-default" name="customer[group_id]">
                    <?php if($this->getRequest()->getGet('id')) :?>
                      <option value="<?php echo $customer->group_id ;?>"><?php echo $this->getSelectedGroup($customer->group_id); ?></option>
                      <?php else: ?>
                      <option value="" disabled selected>Please Choose Group Name</option>
                      <?php endif; ?>
                      <?php
                            $groupNames = $this->getGroupName();
                            foreach ($groupNames->getData() as $key => $value):
                      ?>
                          <option value="<?php echo $value->group_id ?>"><?php echo $value->name ?></option>
                    <?php  endforeach; ?>                     
                    </select>
                    </div> 
                </div>
                
                <?php if(!$this->getRequest()->getGet('id')): ?>
                <button class="btn waves-effect waves-light" type="button" name="add" onclick="mage.resetParam().setForm('#formCustomer').load();">Add Customer
                    <i class="material-icons right">add</i>
                </button>
                <?php else: ?>
                  <button class="btn waves-effect waves-light" type="button" name="add" onclick="mage.resetParam().setForm('#formCustomer').load();">Update Customer
                    <i class="material-icons right">edit</i>
                </button>
                <?php endif; ?>
                <button class="btn waves-effect waves-light" type="button" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid', null, null, true); ?>').load()" name="cancel" >Cancel
                    <i class="material-icons right">close</i>
                </button>
                </div>
            </div>  
            </p>
          </div>
        </div>
    </div>
</form>
