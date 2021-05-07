<?php

namespace Block\Core\Layout;

\Mage::loadClassByFileName("Block\Core\Template");

class Sidebar extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate("./core/layout/sidebar.php");
    }    
}

?>