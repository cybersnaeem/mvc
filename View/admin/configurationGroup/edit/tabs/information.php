<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post" id="formCgroup">

                        <?php if ($this->getRequest()->getGet('id')):  ?>
                            <p class="h2 text-center">Update Configuration Group Details</p><br>
                        <?php else: ?>
                            <p class="h2 text-center">Add Configuration Group Details</p><br>
                        <?php endif; ?>
                    <div class="row">
                        <?php $configGroup = $this->getConfigGroup(); ?>
                        
                        <div class="form-group col-md-6">
                            <label for="name">Configuration Group Name</label>
                            <input id="name" name="configurationGroup[name]" value="<?php echo $configGroup->name ?>" type="text" class="validate" require>
                        </div>

                    </div>

                    <?php if (!$this->getRequest()->getGet('id')):  ?>

                        <button class="btn btn-primary" type="button" onclick="mage.resetParam().setForm('#formCgroup').load();" name="add">Add Configuration Group
                            <i class="fa fa-plus"></i>
                        </button>
                    <?php  else: ?>
                        <button class="btn btn-primary" type="button" onclick="mage.resetParam().setForm('#formCgroup').load();" name="add">Update Configuration Group
                            <i class="fa fa-plus"></i>
                        </button>
                    <?php  endif; ?>
                    <button type="button" class="btn btn-warning" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid', null, null, true); ?>').load()">Reset <i class="fa fa-undo"></i></button>
                    <a class="btn btn-danger" href="<?php echo $this->getUrl()->getUrl('grid', null, null, true); ?>">Cancel <i class="fa fa-times"></i></a>
                </fieldset>
            </form>

        </div>
    </div>
</div>




