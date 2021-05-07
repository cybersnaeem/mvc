<form method="POST" id="filterData" action="<?php echo $this->getUrl()->getUrl('filter','admin\configurationGroup'); ?>">
<?php $pager = $this->pagination()->getPager(); ?>
<div class="row">
    <?php foreach ($this->getButton() as $key => $button) : ?>
         <div class="input-field col s12">
         <button type="button" onclick="<?php echo $this->getButtonUrl($button['method']); ?>" class="btn waves-effect waves-light text-light cgreen" name="update"><?php echo $button['label']; ?>
                    <i class="<?php echo $button['class']; ?>"><?php echo $button['icon']; ?></i>
        </button>                    
        </div>
        <?php endforeach; ?>
   </div>
    <div class="container-fluid">
        <div class="card text-left">
          <div class="card-body">
            <h4 class="card-title">Attribute Details</h4>
            <p class="card-text">
            <table class="highlight">
            <thead>
            <tr>
                <?php //print_r($this->getColumns()) ?>
                <?php  foreach ($this->getColumns() as $key => $column):?>
                    <th><?php echo $column['label'] ?></th>
                <?php endforeach; ?> 
                <th colspan="2">Action</th>
            </tr>
            <tr>
                    <?php foreach ($this->getColumns() as $filterColumn) : ?>
                        <td>
                            <div>
                                <input type="text" class="form-control" id="<?php echo $filterColumn['field']; ?>" name="filter[<?php echo $filterColumn['type']; ?>][<?php echo $filterColumn['field']; ?>]" value="<?php echo $this->getFilter()->getFilterValue($filterColumn['type'], $filterColumn['field']); ?>">
                            </div>
                        </td>
                    <?php endforeach; ?>
                    <td colspan="3">

                    
                    <div class="input-field">
                        </div>
                    </td>
            </tr>
            
        </thead>

            <tbody>
            <?php 
             $data = $this->getPaginationConfigGroup();
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
                                    <?php foreach ($this->getActions() as $action) : ?>
                                        <th>
                                            <a onclick="<?php echo $this->getMethodUrl($value, $action['method']); ?>" class="<?php echo $action['class']?>" href="javascript:void(0);">
                                                <i class="material-icons"><?php echo $action['icon'] ?></i>
                                            </a>
                                        </th>
                                        
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
    