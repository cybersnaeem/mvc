<?php

namespace Block\Core\Layout;

\Mage::loadClassByFileName("block\core\Template");

class Header extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate("./core/layout/header.php");
    }    
}

?>