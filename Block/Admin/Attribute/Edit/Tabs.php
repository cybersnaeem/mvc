<?php

namespace Block\Admin\Attribute\Edit;

class Tabs extends \Block\Core\Edit\Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/attribute/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('attribute', ["label" => "Attribute Information", "className" => 'Block\Admin\Attribute\Edit\Tabs\Form']);
        if($this->getRequest()->getGet('id')){
            $this->addTab('option', ["label" => "Option Information", "className" => 'Block\Admin\Attribute\Edit\Tabs\Option']);
        }
        $this->setDefaultTab('attribute');
    }
}
