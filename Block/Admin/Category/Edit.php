<?php

namespace Block\Admin\Category;

\Mage::loadClassByFileName('block\core\Template');

class Edit extends \Block\Core\Template{
  protected $categories = null;

  public function __construct()
  {
      parent::__construct();
      $this->setTemplate('./admin/category/edit.php');
  }

  public function getTabContent()
  {
        $tabsObj = \Mage::getBlock("block\admin\category\Edit\Tabs");
        $tabs = $tabsObj->getTabs();
        $fetchTab = $this->getRequest()->getGet('tab'); 
         if(!array_key_exists($fetchTab,$tabs))   
         {
            $fetchTab = $tabsObj->getDefault();   
         }
         $gotTab = \Mage::getBlock($tabs[$fetchTab]['className']); 
         echo $gotTab->toHtml();

  }

}

?>