<?php

namespace Block\Core\Layout;

\Mage::loadClassByFileName("block\core\Template");

class Footer extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate("./core/layout/footer.php");
    }    
}

?>