<?php

namespace Block\Home;

use Block\Core\Template;
use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class ShopBy extends \Block\Core\Template
{
    protected $attributes = null;

    public function __construct()
    {
        $this->setTemplate('./home/shop_by.php');
    }

    public function setAttributes()
    {
        $query = "SELECT *
        FROM `attribute`
        WHERE `entityTypeId` = 'product';";

        $this->attributes = Mage::getModel("Model\Attribute")->fetchAll($query);
        return $this;
    }

    public function getAttributes()
    {
        if (!$this->attributes) {
            $this->setAttributes();
        }

        return $this->attributes;
    }

    public function getFilters($attribute)
    {
        $option = Mage::getModel($attribute->backendModel);
        $options = $option->setAttribute($attribute)->getOption();
        return $options;
    }

}
