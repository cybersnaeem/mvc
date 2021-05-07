<div id = "contentHtml">
<?php

$children = $this->getChildren();

foreach ($children as $key => $value):
   echo $value->toHtml();
endforeach

?>
</div>

<script>
  var mage = new Base();
</script>