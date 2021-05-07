<?php

namespace Block\Home;

use Mage;

Mage::loadClassByFileName("Block\Core\Template");

class Brand extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate("./home/brand.php");
    }

    public function getBrand()
    {
        $brand = Mage::getModel('Model\Brand');
        $query = "select * from brand";
        return $brand->fetchAll($query);
    }
}
