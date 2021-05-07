<?php

namespace Block\Admin\Brand\Edit\Tabs;

use Mage;

class Form extends \Block\Core\Edit
{
    protected $brands = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/brand/edit/tabs/form.php");
    }

    public function setBrand($brands = null)
    {
        if (!$brands) {
            $brands = Mage::getModel("Model\Brand");
            if ($id = $this->getRequest()->getGet('id')) {
                $brand = $brands->load($id);
                if (!$brand) {
                    return null;
                }
            }
        }
        $this->brands = $brands;
        return $this;
    }
    public function getBrand()
    {
        if (!$this->brands) {
            $this->setBrand();
        }
        return $this->brands;
    }
}
