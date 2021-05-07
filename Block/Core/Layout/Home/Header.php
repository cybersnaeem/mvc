<?php

namespace Block\Core\Layout\Home;

use Block\Core\Template;
use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class Header extends \Block\Core\Template
{

    public function __construct()
    {
        $this->setTemplate('./core/layout/home/header.php');
    }
}
