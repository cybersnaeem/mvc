<?php

namespace Block\Core\Layout;

\Mage::loadClassByFileName("block\core\Template");

class Message extends \Block\Core\Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./core/layout/message.php");
    }    
}

?>