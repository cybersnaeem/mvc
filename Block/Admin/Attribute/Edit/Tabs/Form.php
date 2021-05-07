<?php

namespace Block\Admin\Attribute\Edit\Tabs;


class Form extends \Block\Core\Edit
{
    protected $attributes = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/attribute/edit/tabs/form.php");
    }

    public function setAttribute($attributes = null)
    {
        if (!$attributes) {
            $attributes = \Mage::getModel("Model\Attribute");
            if ($id = $this->getRequest()->getGet('id')) {
                $attribute = $attributes->load($id);
                if (!$attribute) {
                    return null;
                }
            }
        }
        $this->attributes = $attributes;
        return $this;
    }

    public function getAttribute()
    {
        if (!$this->attributes) {
            $this->setAttribute();
        }
        return $this->attributes;
    }
}
