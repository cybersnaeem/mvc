<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post" id="formAttr"> 

                        <?php if ($this->getRequest()->getGet('id')):  ?>
                            <p class="h2 text-center">Update Attribute Details</p><br>
                        <?php else: ?>
                            <p class="h2 text-center">Add Attribute Details</p><br>
                        <?php endif; ?>
             

                    <div class="row">

                        <?php $attribute = $this->getAttribute();  ?>
                        <div class="form-group col-md-12">
                            <label for="entityTypeId">Entity Type</label>
                            <select id="entityTypeId" name="attribute[entityTypeId]" class="validate form-control" require>
                                <option value="0" selected disabled>Select Entity Type</option>
                                <?php foreach ($attribute->getEntityType() as $key => $value) : ?>
                                    <option value="<?php echo $key; ?>" <?php echo ($attribute->entityTypeId == $key) ? "selected" : ""; ?>><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Attribute Name</label>
                            <input id="name" name="attribute[name]" value="<?php echo $attribute->name ?>" type="text" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="code">Code</label>
                            <input id="code" name="attribute[code]" value="<?php echo $attribute->code ?>" type="text" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputType">Input Type</label>
                            <select id="inputType" name="attribute[inputType]" class="validate form-control" require>
                                <option value="0" selected disabled>Select Input Type</option>
                                <?php foreach ($attribute->getInputTypeOption() as $key => $value) : ?>
                                    <option value="<?php echo $key; ?>" <?php echo ($attribute->inputType == $key) ? "selected" : ""; ?>><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputType">Backend Type</label>
                            <select id="inputType" name="attribute[backendType]" class="validate form-control" require>
                                <option value="0" selected disabled>Select Backend Type</option>
                                <?php foreach ($attribute->getBackendTypeOption() as $key => $value) : ?>
                                    <option value="<?php echo $key; ?>" <?php echo ($attribute->backendType == $key) ? "selected" : ""; ?>>
                                        <?php echo $value; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="sortOrder">Sort Order</label>
                            <input id="sortOrder" name="attribute[sortOrder]" value="<?php echo $attribute->sortOrder ?>" type="number" class="validate form-control" require>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="backendModel">Backend Model</label>
                            <input id="backendModel" name="attribute[backendModel]" value="<?php echo $attribute->backendModel ?>" type="text"  class="validate form-control" require>
                        </div>




                    </div>

                    <?php if (!$this->getRequest()->getGet('id')):  ?>

                        <button class="btn btn-primary" type="button" onclick="mage.resetParam().setForm('#formAttr').load();" name="add">Add Attribute
                            <i class="fa fa-plus"></i>
                        </button>
                    <?php  else: ?>
                        <button class="btn btn-primary" type="button" onclick="mage.resetParam().setForm('#formAttr').load();" name="add">Update Attribute
                            <i class="fa fa-plus"></i>
                        </button>
                    <?php  endif; ?>
                    <button type="button" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid', null, null, true); ?>').load()" class="btn btn-warning">Reset<i class="fa fa-undo"></i></button>
                    <a class="btn btn-danger" href="<?php echo $this->getUrl()->getUrl('grid', null, null, true); ?>">Cancel <i class="fa fa-times"></i></a>
                </fieldset>
            </form>

        </div>
    </div>
</div>




