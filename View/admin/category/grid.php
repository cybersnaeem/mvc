
    <div class="row">
         <div class="input-field col s12">
         <a href="<?php echo $this->getUrl()->getUrl('form');?>" class="btn waves-effect waves-light text-light cgreen" name="update">Add Category
                    <i class="material-icons right">add</i>
        </a>                    
        </div>
   </div>
    <div class="container-fluid">
  
        <div class="card text-left">
          <div class="card-body">
            <h4 class="card-title"><?php echo $this->getTitle(); ?></h4>
            <p class="card-text">
            <table class="highlight">
            <thead>
            <tr>
                <th>Category Name</th>
                <th>Parent Id</th>
                <th>Path Id</th>
                <th>Status</th>
                <th>Description</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $data = $this->getCategories();
                if($data == ""):
                    echo '<p class=text-center><strong>No Record Found</strong><p>';    
                else:
                    foreach($data->getData() as $record):
            ?>
            <tr id="txtData">
                <td><?php echo $record->categoryName ?></td>
                <td><?php echo $record->parentId ?></td>
                <td><?php echo $record->pathId ?></td>
                <td><?php 
                        if($record->status):
                            echo 'Enabled';
                        else:
                            echo 'Disabled';
                        endif;
                    ?>
                </td>
                <td><?php echo $record->description ?></td>
                <th>
                    <a href="<?php echo $this->getUrl()->getUrl('changeStatus',NULL,['id'=>$record->categoryId,'status'=>$record->status],true);?>" class="btn-floating waves-effect waves-light blue">
                        <i class="material-icons">
                            <?php
                                if($record->status == 1):
                                    echo "gps_fixed";
                                else:
                                    echo "gps_not_fixed";
                                endif;
                            ?>
                        </i>
                    </a>
                </th>
                <th><a href="<?php echo $this->getUrl()->getUrl('form',NULL,['id'=>$record->categoryId]); ?>" class="btn-floating waves-effect waves-light yellow"><i class="material-icons">edit</i></a></th>
                <th><a href="<?php echo $this->getUrl()->getUrl('delete',NULL,['id'=>$record->categoryId]); ?>" class="btn-floating waves-effect waves-light red"><i class="material-icons" >delete</i></a></th>
            
            </tr>
           <?php 
                endforeach;
            endif;
           ?> 
            </tbody>
        </table>
            </p>
          </div>
          
        </div>
       
    </div>  