<?php

namespace Block\Core\Layout\Home;

use \Block\Core\Template;
use Mage;

Mage::loadClassByFileName("Block\Core\Template");

class Message extends Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./core/layout/home/message.php");
    }
}
