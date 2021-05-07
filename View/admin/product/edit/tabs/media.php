

    <div class="container">
        <div class="card text-left">
            <div class="card-body">
                <h4 class="card-title">
                    <p class="h2 text-center">Media</p><br>
                </h4>
                <form method="post" action="<?php echo $this->getUrl()->getUrl('check', 'admin\media'); ?>">
                    <div class="text-right">
                        <button class="btn waves-effect waves-dark yellow" type="submit" name="update">Update
                            <i class="material-icons right">edit</i>
                        </button>
                        <button class="btn waves-effect waves-light red" type="submit" name="delete">Delete
                            <i class="material-icons right">delete</i>
                        </button>
                    </div>
                    <p class="card-text">
                    <div class="row">

                        <table class="highlight">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Label</th>
                                    <th>Small</th>
                                    <th>Thumb</th>
                                    <th>Base</th>
                                    <th>Gallery</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $imageData = $this->getImageData($this->getRequest()->getGet('id'));
                                $id = $this->getRequest()->getGet('id');
                                    if(!$imageData):
                                    ?>
                                    <tr>
                                        <th colspan="5" class="text-center">No Images Uploaded For This Product</th>                                    
                                    </tr>
                                    <?php
                                        else:
                                        foreach ($imageData->getData() as $key => $value) :
                                    ?>
                                    <tr>
                                        <td><img src="./Media/Images/Product/<?php echo "{$id}/". $value->imageName ?>" height="100px" width="100px" alt=""></td>
                                        <td><input type="text" name="image[<?php echo $value->productGalleryId; ?>][imagelabel]" value="<?php echo $value->imagelabel; ?>"> </td>
                                        <td> 
                                            <label>
                                                <input value="<?php echo $value->productGalleryId; ?>" name="image[small]" type="radio" <?php echo $value->small ? "checked" : "" ?> />
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input value="<?php echo $value->productGalleryId; ?>" name="image[thumb]" type="radio" <?php echo $value->thumb ? "checked" : "" ?> />
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input value="<?php echo $value->productGalleryId; ?>" name="image[base]" type="radio" <?php echo $value->base ? "checked" : "" ?> />
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="image[<?php echo $value->productGalleryId; ?>][gallery]" <?php echo $value->gallery ? "checked" : "" ?> />
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="image[<?php echo $value->productGalleryId; ?>][remove]" />
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                <?php 
                                    endforeach;    
                                    endif; 
                                ?>
                            </tbody>

                        </table>

                        </p>
                    </div>

                </form>
                <form method="post" action="<?php echo $this->getUrl()->getUrl('save', 'admin\media'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Example file input</label>
                        <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1">

                    </div>
                    <button class="btn waves-effect waves-dark blue" type="submit" name="add">Upload
                        <i class="material-icons right">add</i>
                    </button>

            </div>
            </form>
        </div>
        <br>
        <br>

