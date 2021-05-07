<?php

namespace Block\Admin\Product\Edit\Tabs;

class Attribute extends \Block\Core\Edit
{
    protected $products = null;
    protected $attributes = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/product/edit/tabs/attribute.php");
    }

    public function setProduct($products = null)
    {
        if (!$products) {
            $products = \Mage::getModel("Model\Product");
            if ($id = $this->getRequest()->getGet('id')) {
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


    public function getAttributes()
    {
        $attribute = \Mage::getModel("Model\Attribute");
        $query = "select * from attribute where entityTypeId='product' ORDER BY sortOrder ASC";
        $attributes = $attribute->fetchAll($query);

        return $attributes;
    }

    public function getOptions($id)
    {
        $option = \Mage::getModel("Model\Attribute\Option");

        $query = "select * from attribute_option where attributeId='{$id}' ORDER BY sortOrder ASC";
        $options = $option->fetchAll($query);

        return $options;
    }
}
