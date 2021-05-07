<?php

namespace Block\Admin\Product\Edit\Tabs;


class Form extends \Block\Core\Edit
{
    protected $products = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/product/edit/tabs/form.php");
    }

    public function setProduct($products = null)
    {
        if (!$products) 
        {
            $products = \Mage::getModel("Model\product");
            if ($id = $this->getRequest()->getGet('id')) 
            {
                $product = $products->load($id);
                if (!$product) {
                    return null;
                }
            }  
        }
        $this->products = $products;
        return $this;
    }

    public function getProduct()
    {
        if (!$this->products) {
            $this->setProduct();
        }
        return $this->products;     
    }  

}