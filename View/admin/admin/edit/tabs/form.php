
<form action="<?php echo $this->getUrl()->getUrl('save');?>" method="post" id="formAdmin">
    <?php $admin =$this->getAdmin(); ?>
    <div class="container">
        <div class="card text-left">
          <div class="card-body">
            <h4 class="card-title">
            <?php if($this->getRequest()->getGet('id')) :?>
              <p class="h2 text-center">Update Admin Details</p><br>
          <?php else: ?>
              <p class="h2 text-center">Add Admin Details</p><br>
          <?php endif;?>
            </h4>
            <p class="card-text">
            <div class="row">
                <div class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                    <input id="adminName" name="admin[adminName]" value="<?php echo $admin->adminName ?>" type="text" class="validate">
                    <label for="adminName">Name</label> 
                    </div>
                    <div class="input-field col s6">
                    <input id="adminPass" name="admin[adminPassword]" value="<?php echo $admin->adminPassword ?>" type="password" class="validate">
                    <label for="adminPass">Password</label>
                    </div>
                    <div class="input-field col s6">
                    <div class="switch">
                            <label>
                            Disabled
                            <?php if($admin->status):
                                    $label = 'checked'; 
                                  else:
                                        $label = '!checked';  
                                  endif;  
                                ?>
                            <input name='admin[status]' type='checkbox' <?php echo $label; ?>> 
                            <span class="lever"></span>
                            Enabled
                            </label>
                        </div>
                    </div>
                </div>
                <?php if(!$this->getRequest()->getGet('id')) :?>
                <button class="btn waves-effect waves-light" type="button" onclick="mage.resetParam().setForm('#formAdmin').load();" name="add">Add Admin
                    <i class="material-icons right">add</i>
                </button>
                <?php else: ?>
                  <button class="btn waves-effect waves-light" type="button" onclick="mage.resetParam().setForm('#formAdmin').load();" name="add">Update Admin
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
                  