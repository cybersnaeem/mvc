<?php 
$items=$this->getCart()->getItems();
$customers = $this->getCustomers();
$customer = $this->getCart()->getCustomer();
?>
<div class='container-fluid'>
    
    <h4 class="display-5">Cart Details</h4>
    
    <form method="POST" id="cartForm" action="<?php echo $this->getUrl()->getUrl('update','admin\cart')?>">
        <div class="form-group">
        <table class="table">
                    <thead>
                    <tr>
                        <td><a class="btn btn-primary" href="javascript:void(0);" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid','admin\product');?>').resetParam().load();" <?php //echo $this->getUrl()->getUrl('grid','admin\product');?>>Back</a></td>
                        <td colspan="7"><button type="button" onclick="mage.resetParam().setForm('#cartForm').load();" class="btn btn-primary">Update Cart</button></td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <select name="customer" class="form-control" onchange="selectCustomer(); mage.resetParam().setForm('#cartForm').load();">
                                <option>Select Customer</option>
                                <?php foreach ($customers->getData() as $key => $value):?>
                                    <option value="<?php echo $value->customerId?>" name="customer" <?php if($value->customerId == $customer->customerId){ echo "Selected";}?>> <?php echo $value->firstName?></option>
                                <?php endforeach;?>
                            </select>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary blue" >Search</button>
                        </td>
                    </tr>
                    <tr>
                        <th>Cart Item Id</th>
                        <th>Product Id</th>
                        <th>Quantity</th>
                        <th>price</th>
                        <th>Discount</th>
                        <th>Base Price</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!$items) :?>
                        <tr>
                            <td colspan=8>No Record Found</td>
                        </tr>
                    <?php else: ?>
                    <?php foreach ($items->getData() as $key => $item):?>
                      <tr>
                       <td><?php echo $item->cartItemId;?></td>
                        <td><?php echo $item->productId;?></td>
                        <td><input type="number" name="quantity[<?= $item->cartItemId ?>]" value="<?php echo $item->quantity;?>"></td>
                        <td><input type="number" name="price[<?= $item->cartItemId ?>]" value="<?php echo $item->price;;?>"></td>
                        <td><?php echo $item->discount;?></td>
                        <td><?php echo $item->basePrice; ?></td>
                        <td><?php echo  $item->quantity * $item->price - ($item->price * $item->discount / 100) ?></td>
                        <td>
                            <a onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('delete',NULL,['id'=> $item->cartItemId])?>').resetParam().load();"  href='javascript:void(0);'
                            class="btn btn-danger red">Delete</a>
                        <td>
                      </tr>
                      <?php endforeach?>
                      <tr>
                            <th colspan="6">
                                Grand Total:
                            </th>
                            <th>
                                 <?php  echo $this->getTotal() ?>
                            </th>
                    </tr>
                    <tr>
                    <td colspan="8"><?php if($items):?><a href="javascript:void(0);" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('checkout','admin\cart'); ?>').resetParam().load();"  class="aa-cart-view-btn" >Proced to Checkout</a><?php endif;?></td>    
                    </tr>
                    <?php  endif; ?>
                      </tbody>
                  </table>
        </div> 
    </form>
    
</div>   

<script type="text/javascript">
    function selectCustomer() {
        var form = document.getElementById('cartForm');
        form.setAttribute('Action','<?php echo $this->getUrl()->getUrl('selectCustomer','admin\cart');?>');
    }
</script>
           