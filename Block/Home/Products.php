<?php

namespace Block\Home;

use Block\Core\Template;
use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class Products extends \Block\Core\Template
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./home/products.php');
    }

    public function getProducts()
    {
        if ($categoryId = $this->getRequest()->getGet('categoryId')) {
            $query = "SELECT * FROM `product` where status=1 and categoryId={$categoryId};";
            return Mage::getModel('Model\Product')->fetchAll($query);
        }
        $query = "SELECT * FROM `product` where `status`=1;";

        return Mage::getModel('Model\Product')->fetchAll($query);
    }

    public function getMedia($id)
    {
        $query = "select * from `productgallery` where small=1 and productId={$id}";
        if ($media = Mage::getModel('Model\Product')->fetchRow($query)) {
            return $media->getOriginalData();
        }
        return false;
    }
}
