<div class="container">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <form action="<?php echo $this->getUrl()->getUrl('save', 'admin\configurationGroup\config'); ?>" method="post" id="form">
                            <p class="h2 text-center">Add/Update Configuration Details</p><br>
                    <div class="row">
                        <div class="form-group col-md-9">
                        </div>
                        <div class="form-group col-md-3">
                        <button class="btn waves-effect waves-light" type="button" name="add" onclick="addOption();">Add&nbsp;Config
                            <i class="material-icons right">add</i>
                        </button>
                        </div>
                    </div>

                    <?php $config = $this->getConfig(); ?>

                    <div class="row" id="existingConfig">
                        <?php if ($config) : ?>
                            <?php foreach ($config->getData() as $key => $value) : ?>
                                <div class="row col-md-12">
                                    <div class="form-group col-md-3">
                                        <label for="title<?php echo $value->configId; ?>">Title</label>
                                        <input id="title<?php echo $value->configId; ?>" name="existing[<?php echo $value->configId; ?>][title]" value="<?php echo $value->title ?>" type="text" class="validate" required>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="code<?php echo $value->configId; ?>">Code</label>
                                        <input id="code<?php echo $value->configId; ?>" name="existing[<?php echo $value->configId; ?>][code]" value="<?php echo $value->code ?>" type="text" class="validate" required>
                                    </div>

                                    
                                    <div class="form-group col-md-3">
                                        <label for="value<?php echo $value->configId; ?>">Value</label>
                                        <input id="value<?php echo $value->configId; ?>" name="existing[<?php echo $value->configId; ?>][value]" value="<?php echo $value->value ?>" type="text" class="validate" required>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="remove">&nbsp;</label>
                                        <a onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('delete', 'admin\configurationGroup\config', ['configId'=>$value->configId], false); ?>').load();"   href="javascript:void(0);" class="btn waves-effect waves-light red" >Delete
                                            <i class="material-icons black">trash</i>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <button class="btn waves-effect waves-light text-dark yellow" type="button" onclick="mage.resetParam().setForm('#form').load();" name="add">Update Configuration
                        <i class="material-icons right">edit</i>
                    </button>
            </form>

        </div>
    </div>
</div>

<div style="display: none;" id="newConfig">
    <div class="row col-md-12">
        <div class="form-group col-md-3">
            <label for="title">Title</label>
            <input id="title" name="new[title][]" type="text" class="validate form-control" required>
        </div>

        <div class="form-group col-md-3">
            <label for="code">Code</label>
            <input id="code" name="new[code][]" type="text"  class="validate form-control" required>
        </div>

        <div class="form-group col-md-3">
            <label for="value">Value</label>
            <input id="value" name="new[value][]" type="text"  class="validate form-control" required>
        </div>

        <div class="form-group col-md-3">
            <label for="remove">&nbsp;</label>
            <button class="btn waves-effect waves-light red" type="button" onclick="removeConfig(this);" name="add">Delete
                    <i class="material-icons right">trash</i>
            </button>
        </div>
    </div>
</div>

<script>
    function removeConfig(removeButton) {
        var config = removeButton.parentElement.parentElement.remove();
    }

    function addOption() {
        var existingConfig = document.getElementById('existingConfig');
        var newConfig = document.getElementById('newConfig').children[0];
        existingConfig.prepend(newConfig.cloneNode(true));
    }
</script>

