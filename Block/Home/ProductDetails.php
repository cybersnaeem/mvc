<?php

namespace Block\Home;

use Mage;

Mage::loadClassByFileName("Block\Core\Template");

class ProductDetails extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate("./home/product_details.php");
    }

    public function getProduct()
    {
        $id = $this->getRequest()->getGet('id');

        if (!$id) {
            return false;
        }

        return Mage::getModel('\Model\Product')->load($id);
    }

    public function getMedia($id)
    {
        $query = "select * from productmedia where productId={$id} and gallery=1";
        return Mage::getModel('\Model\Media')->fetchAll($query);
    }
}
