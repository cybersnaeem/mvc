
<?php $pager = $this->pagination()->getPager(); ?>
    
    <div class="container-fluid">
        <div class="card text-left">
          <div class="card-body">
            <h4 class="card-title"><?php $this->getTitle(); ?></h4>
            <p class="card-text">
            <table class="highlight">
            <thead>
            <tr>
                <?php foreach ($this->getColumns() as $key => $column) : ?>
                    <th><?php echo $column['label']; ?></th>
                <?php endforeach; ?>
            </tr>
            </thead>

            <tbody>     
                        <?php 
                          $data = $this->getPaginationOrderDetails();
                         if ($data == "") : 
                        ?>
                            <tr>
                                <td colspan="6">
                                    <strong>
                                        <?php echo 'No Records Found'; ?>
                                    </strong>
                                </td>
                            </tr>
                        <?php else : ?>
                             
                            <?php foreach ($data->getData() as $value) : ?>
                                            <tr>
                                                <?php foreach ($this->getColumns() as $column) : ?>
                                                    <th><?php echo $this->getFieldValue($value, $column['field']); ?></th>
                                                <?php endforeach; ?>
                                    </tr>
            
            
                            <?php   
                                  endforeach;
                                 endif;
                            ?>
                        </tbody>
        </table>
            </p>
            <div class="d-flex justify-content-center">
               
               <ul class="pagination pagination-lg">
                   <li class="page-item <?php echo (!$pager->getPrevious()) ? 'disabled' : ''; ?>">
                       <a class="page-link text-white" style="background-color: #1fb8ff;" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl(null, null, ['page' => $pager->getPrevious()], true); ?>').load();" href="javascript:void(0);">
                           Previous
                       </a>
                   </li>
                   <?php foreach (range($pager->getStart(), $pager->getNoOfPages()) as $value) : ?>
                       <li class="page-item <?php echo ($this->getRequest()->getGet('page') == $value) ? 'active' : ''; ?>">
                           <a class="page-link" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl(null, null, ['page' => $value], true); ?>').load();" href="javascript:void(0);">
                               <?php echo $value; ?>
                           </a>
                       </li>
                   <?php endforeach; ?>
                   <li class="page-item <?php echo (!$pager->getNext()) ? 'disabled' : ''; ?>">
                       <a class="page-link text-white" style="background-color: #1fb8ff;" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl(null, null, ['page' => $pager->getNext()], true); ?>').load();" href="javascript:void(0);">
                           Next
                       </a>
                   </li>
               </ul>
            </div>
            
          </div>
          
        </div>
       
    </div>
