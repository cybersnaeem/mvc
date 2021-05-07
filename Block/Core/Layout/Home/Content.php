<?php

namespace Block\Core\Layout\Home;

use Mage;

Mage::loadClassByFileName("Block\Core\Template");

class Content extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate("./core/layout/home/content.php");
    }
}
