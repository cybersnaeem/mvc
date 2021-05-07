<?php

namespace Block\Admin\ConfigurationGroup\Edit;

class Tabs extends \Block\Core\Edit\Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/configurationGroup/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('configurationGroup', ["label" => "Information", "className" => 'Block\Admin\ConfigurationGroup\Edit\Tabs\Information']);
        if($this->getRequest()->getGet('id')){
            $this->addTab('config', ["label" => "Configuration", "className" => 'Block\Admin\ConfigurationGroup\Edit\Tabs\Config']);
        }
        $this->setDefaultTab('configurationGroup');
    }
}
