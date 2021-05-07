<?php 

  $tabs = $this->getTabs();
  foreach ($tabs as $key => $value):
   
?>
<div class="list-group" >
  <a  href="javascript:void(0);" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl(null,null,['tab' => $key]); ?>').load();" class="p-4 list-group-item list-group-item-action flex-column align-items-start"  style="background-color: #1fb8ff; color:white">
    <p class="mb-1 font-weight-bold"><?php echo $value['label'] ?></p>
  </a>
</div>

<?php endforeach; ?>