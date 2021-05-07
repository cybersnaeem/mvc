<?php

namespace Block\Admin\Payment;



class Edit extends \Block\Core\Edit
{
  

  public function __construct()
  {
      parent::__construct();
      $this->setTabClass(\Mage::getBlock('Block\Admin\payment\Edit\Tabs'));
      
  }

}

?>