<?php

namespace Block\Admin\CustomerGroup\Edit;


class Tabs extends \Block\Core\Edit\Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/customerGroup/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('customerGroup', ["label" => "Group Information", "className" => 'Block\Admin\CustomerGroup\Edit\Tabs\Form']);
        $this->setDefaultTab('customerGroup');
    }
}
