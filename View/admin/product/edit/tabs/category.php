<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('saveCategory'); ?>" method="post" id="form">
            <fieldset>
                    <legend>
                        <?php if ($this->getRequest()->getGet('id')) { ?>
                            <p class="h2 text-center">Update Category Details</p><br>
                        <?php } else { ?>
                            <p class="h2 text-center">Add Category Details</p><br>
                        <?php } ?>
                    </legend>

                    <div class="row">
                        <?php $category = $this->getCategory()->getData(); ?>

                        <div class="form-group col-md-6">
                            <label for="category">Category</label>
                            <select id="category" name="product[categoryId]" class="form-control">
                                <option value="" disabled selected>Select Category</option>
                                <?php foreach ($category as $id => $category) : ?>
                                    <option value="<?php echo $category->categoryId; ?>" <?php echo ($this->checkCategory($category->categoryId)) ? "selected" : ""; ?>><?php echo $category->categoryName; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <?php if (!$this->getRequest()->getGet('id')) { ?>

                        <button class="btn btn-primary" type="button" onclick="mage.resetParam().setForm('#form').load();" name="add">Add Category
                            <i class="fa fa-plus"></i>
                        </button>
                    <?php } else { ?>
                        <button class="btn btn-primary" type="button" onclick="mage.resetParam().setForm('#form').load();" name="edit">Update Category
                            <i class="fa fa-edit"></i>
                        </button>
                    <?php } ?>
                    <a class="btn btn-danger" href="javascript:void(0);" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid', null, null, true); ?>').load()">Cancel <i class="fa fa-times"></i></a>
                </fieldset>
            </form>

        </div>
    </div>
</div>