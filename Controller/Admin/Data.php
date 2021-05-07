<?php

namespace Controller\Admin;

use Mage;

class Data extends \Controller\Core\Admin
{
    public function testAction()
    {
        $query ="SELECT * FROM `product` ORDER BY productId asc";
        $products = Mage::getModel('Model\product')->fetchAll($query);
        $products->productId = '12';
        $products->productName = "ok";
        foreach ($products->getData() as $key => $value) {
            print_r($value);
        }
       
    }
}


?>