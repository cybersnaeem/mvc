<?php

namespace Block\Admin\Brand\Edit;


class Tabs extends \Block\Core\Edit\Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/brand/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('brand', ["label" => "Brand Information", "className" => 'Block\Admin\Brand\Edit\Tabs\Form']);
        $this->setDefaultTab('brand');
    }
}
