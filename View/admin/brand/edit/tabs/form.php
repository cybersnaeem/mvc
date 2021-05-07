

<form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post" enctype="multipart/form-data" id="formBrand">
        <?php $brand = $this->getBrand(); ?>
    <div class="container">
        <div class="card text-left">
          <div class="card-body">
            <h4 class="card-title">
            <?php if($this->getRequest()->getGet('id')) :?>
        <p class="h2 text-center">Update Brand Details</p><br>
        <?php else: ?>
            <p class="h2 text-center">Add Brand Details</p><br>
        <?php endif;?>
            </h4>
            <p class="card-text">
            <div class="row">
                <div class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                    <input id="brandName" name="brand[name]" value="<?php echo $brand->name ?>" type="text" class="validate">
                    <label for="brandName">Brand Name</label>
                    </div>
                    <div class="input-field col s6">
                    <input id="sortOrder" name="brand[sortOrder]" value="<?php echo $brand->sortOrder ?>" type="text" class="validate">
                    <label for="sortOrder">Sort Order</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                            <?php if($this->getRequest()->getGet('id')): ?>
                                <img src="./Media/Brand/<?php echo "{$brand->brandId}"; ?>/<?php echo "{$brand->image}"; ?>" alt="" height="100px" width="100px">
                            <?php endif; ?>
                            <input id="image" name="image" value="<?php echo $brand->image ?>" type="file" placeholder="BRAND IMAGE" class="validate form-control">
                    </div>
                    <div class="input-field col s6">
                        <div class="input-field col s6">
                        <div class="switch">
                            <label>
                            Disabled
                            <?php if($brand->status):
                                    $label = 'checked'; 
                                  else:
                                        $label = '!checked';  
                                  endif;
                                ?>
                            <input name='brand[status]' type='checkbox' <?php echo $label; ?>> 
                            <span class="lever"></span>
                            Enabled
                            </label>
                        </div>
                        </div>
                    </div>
                    
                </div>

                
                
                <?php if(!$this->getRequest()->getGet('id')): ?>
                <button class="btn waves-effect waves-light" type="button" onclick="mage.resetParam().setForm('#formBrand').load();" name="add">Add Brand
                    <i class="material-icons right">add</i>
                </button>
                <?php else: ?>
                  <button class="btn waves-effect waves-light" type="button" onclick="mage.resetParam().setForm('#formBrand').load();" name="add">Update Brand
                    <i class="material-icons right">edit</i>
                </button>
                <?php endif; ?>
                <button class="btn waves-effect waves-light" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid', null, null, true); ?>').load()" type="button" name="cancel">Cancel
                    <i class="material-icons right">close</i>
                </button>
                </div>
            </div>  
            </p>
          </div>
        </div>
    </div>
    </form>
