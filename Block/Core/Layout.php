<?php

namespace Block\Core;

\Mage::loadClassByFileName('Block\Core\Template');

class Layout extends \Block\Core\Template{
    public function __construct()
    {
        $this->setTemplate("./core/layout/one_column.php");
        $this->prepareChildren();
    }
    public function prepareChildren()
    {
        $sidebar = \Mage::getBlock("block\core\layout\sidebar");
        $this->addChild($sidebar,"Sidebar");
        
        $header = \Mage::getBlock("block\core\layout\header");
        $this->addChild($header,"Header");
        
        $footer = \Mage::getBlock("block\core\layout\Footer");
        $this->addChild($footer,"Footer");
        
        $content = \Mage::getBlock("block\core\layout\content");
        $this->addChild($content,"Content");

    }
}

?>