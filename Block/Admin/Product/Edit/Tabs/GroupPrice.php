<?php

namespace Block\Admin\Product\Edit\Tabs;


class GroupPrice extends \Block\Core\Edit
{

    protected $product = [];
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/product/edit/tabs/groupPrice.php");
    }

    public function getPriceGroup($id)
    {
        $customerGroupmodel = \Mage::getModel('Model\GroupPrice');
        $productModel = \Mage::getModel('Model\Product');

        $product = $productModel->load($this->getRequest()->getGet('id'));

        $query = "SELECT cg.*,pgp.productId,pgp.entityId,pgp.groupPrice, 
                if(p.productPrice IS NULL,'{$product->productPrice}',p.productPrice) as price
                FROM customer_group cg
                    LEFT JOIN product_group_price pgp 
                        ON pgp.groupId = cg.group_id
                            AND pgp.productId = '{$product->productId}'
                    LEFT JOIN product p
                        ON pgp.productId = p.productId
        ";

        $priceGroup = $customerGroupmodel->fetchAll($query);

        return $priceGroup;
    }

}   
