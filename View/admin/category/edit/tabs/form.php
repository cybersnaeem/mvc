<?php 
    $category = $this->getCategory();
    $categoryOptions = $this->getCategoryOptions();
?>

<form action="<?php echo $this->getUrl()->getUrl('save');?>" method="post">
    <?php $category = $this->getCategory(); ?>
    <div class="container">
        <div class="card text-left">
          <div class="card-body">
            <h4 class="card-title">
            <?php if($this->getRequest()->getGet('id')) :?>
              <p class="h2 text-center">Update Category Details</p><br>
          <?php else: ?>
              <p class="h2 text-center">Add Category Details</p><br>
          <?php endif;?>
            </h4>
            <p class="card-text">
            <div class="row">
                <div class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                    <select class="browser-default" name="category[parentId]">
                    <?php foreach ($categoryOptions as $categoryId => $categoryName): ?>
                        <option value="<?php echo $categoryId;?>" <?php if($categoryId == $category->parentId) :?> selected <?php endif;?>> <?php echo $categoryName;?></option>
                    <?php endforeach;?>
                    </select>                
                    </div>
                    <div class="input-field col s6">
                    <input id="categoryname" name="category[categoryName]" value="<?php echo $category->categoryName ?>" type="text" class="validate">
                    <label for="categoryname">Name</label>
                    </div>
                    
                </div>
                <div class="row">
                <div class="input-field col s6">
                    <div class="switch">
                            <label>
                            Disabled
                            <?php if($category->status):
                                    $label = 'checked'; 
                                  else:
                                        $label = '!checked';  
                                  endif;
                                ?>
                            <input name='category[status]' type='checkbox' <?php echo $label; ?>> 
                            <span class="lever"></span>
                            Enabled
                            </label>
                        </div>
                    </div>
                        <div class="input-field col s6">
                        <textarea id="desc" name="category[description]" class="materialize-textarea"><?php echo $category->description ?></textarea>
                        <label for="desc">Description</label>
                        </div>
                </div>
                <?php if(!$this->getRequest()->getGet('id')) :?>
                <button class="btn waves-effect waves-light" type="submit" name="add">Add Category
                    <i class="material-icons right">add</i>
                </button>
                <?php else: ?>
                  <button class="btn waves-effect waves-light" type="submit" name="add">Update Category
                    <i class="material-icons right">edit</i>
                </button>
                <?php endif; ?>
                <button class="btn waves-effect waves-light" type="reset" name="cancel">Cancel
                    <i class="material-icons right">close</i>
                </button>
                
                </div>
            </div>  
            </p>
          </div>
        </div>
    </div>
    </form>