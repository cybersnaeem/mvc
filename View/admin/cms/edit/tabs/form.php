
<!doctype html>
<html lang="en">
  <head>
    <title>Add Customer</title>
    <script src="https://cdn.tiny.cloud/1/krxtmava3rbfbh6xktd048nd8i41usepo5kmtnbrksyew15w/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- Required meta tags -->
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
        toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name'
    });
</script>
  </head>
  <body>
    <form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post" id="formCms">
    <div class="container">
        <div class="card text-left">
          <div class="card-body">
            <h4 class="card-title">
            <?php if($this->getRequest()->getGet('id')) :?>
                  <p class="h2 text-center">Update CMS Page Details</p><br>
            <?php else: ?>
                    <p class="h2 text-center">Add CMS Page Details</p><br>
            <?php endif;?>
            </h4>
            <?php $cms = $this->getCms(); ?>
            <p class="card-text">
            <div class="row">
                <div class="col s12">
                <div class="row">
                    <div class="input-field col s4">
                    <input id="fname" name="cms[title]" value="<?php echo $cms->title ?>" type="text" class="validate">
                    <label for="fname">Title</label>
                    </div>
                    <div class="input-field col s4">
                    <input id="lname" id="identifier " name="cms[identifier]" value="<?php echo $cms->identifier ?>" type="text" class="validate">
                    <label for="lname">Identifier</label>
                    </div>
                    <div class="input-field col s4">
                        <div class="switch">
                            <label>
                            Disabled
                            <?php if($cms->status):
                                    $label = 'checked'; 
                                else:
                                        $label = '!checked';  
                                endif;
                                ?>
                            <input name='customer[status]' type='checkbox'  name='cms[status]'  <?php echo $label; ?>> 
                            <span class="lever"></span>
                            Enabled
                            </label>
                        </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col s12">
                            <label for="content"></label>
                            <textarea id="content" name="cms[content]" class="form-control"><?php echo $cms->content; ?></textarea>               
                    </div>
                </div>

                  
                <?php if(!$this->getRequest()->getGet('id')): ?>
                <button class="btn waves-effect waves-light" type="button" onclick="mage.resetParam().setForm('#formCms').load();" name="add">Add CMS Page
                    <i class="material-icons right">add</i>
                </button>
                <?php else: ?>
                  <button class="btn waves-effect waves-light" type="button" onclick="mage.resetParam().setForm('#formCms').load();" name="add">Update CMS Page
                    <i class="material-icons right">edit</i>
                </button>
                <?php endif; ?>
                <button class="btn waves-effect waves-light" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid', null, null, true); ?>').load()" name="cancel">Cancel
                    <i class="material-icons right">close</i>
                </button>
                </div>
            </div>  
            </p>
          </div>
        </div>
    </div>
    </form>
 
  </body>
</html>
