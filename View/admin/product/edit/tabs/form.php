<form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post" id="formProduct">

          <?php $product =$this->getProduct(); ?>
    <div class="container">
        <div class="card text-left">
          <div class="card-body">
            <h4 class="card-title">
            <?php if($this->getRequest()->getGet('id')) :?>
              <p class="h2 text-center">Update Product Details</p><br>
          <?php else: ?>
              <p class="h2 text-center">Add Product Details</p><br>
          <?php endif;?>
            </h4>
            <p class="card-text">
            <div class="row">
                <div class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                    <input id="sku" name="product[SKU]" value="<?php echo $product->SKU ?>" type="text" class="validate">
                    <label for="sku">SKU</label>
                    </div>
                    <div class="input-field col s6">
                    <input id="productname" name="product[productName]" value="<?php echo $product->productName ?>" type="text" class="validate">
                    <label for="productname">Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                    <input id="price" name="product[productPrice]" value="<?php echo $product->productPrice ?>" type="text" class="validate">
                    <label for="price">Price</label>
                    </div>
                    <div class="input-field col s6">
                    <input id="discount" name="product[productDiscount]" value="<?php echo $product->productDiscount ?>" type="text" class="validate">
                    <label for="discount">Discount</label>
                    </div>
                    
                </div>
                <div class="row">
                        <div class="input-field col s12">
                        <textarea id="desc" name="product[description]" class="materialize-textarea"><?php echo $product->description ?></textarea>
                        <label for="desc">Description</label>
                        </div>
                </div>
                <div class="row">
                        <div class="input-field col s6">
                        <input id="quantity" name="product[productQty]" type="number" value="<?php echo $product->productQty ?>" min="1" max="10" class="validate">
                            <label for="quantity">Quantity</label>
                        </div>
                        <div class="input-field col s6">
                        <div class="switch">
                            <label>
                            Disabled
                            <?php if($product->status):
                                      $label = 'checked'; 
                                      $value = '1';
                                    else:
                                        $label = '!checked';
                                        $value = '0';  
                                    endif;
                                ?>
                            <input name='product[status]' type='checkbox' <?php echo $label; ?>> 
                            <span class="lever"></span>
                            Enabled
                            </label>  
                        </div>
                        </div>
                </div>
                <?php if(!$this->getRequest()->getGet('id')) :?>
                <button class="btn waves-effect waves-light" type="button" onclick="mage.resetParam().setForm('#formProduct').load();" name="add">Add Product
                    <i class="material-icons right">add</i>
                </button>
                <?php else: ?>
                <button class="btn waves-effect waves-light" type="button" onclick="mage.resetParam().setForm('#formProduct').load();" name="edit">Update Product
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
    <br>
    <br>
