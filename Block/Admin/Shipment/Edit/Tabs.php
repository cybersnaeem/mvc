<?php

namespace Block\Admin\Shipment\Edit;


class Tabs extends \Block\Core\Edit\Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/shipment/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('shipment', ["label" => "Shipment Information", "className" => 'Block\Admin\Shipment\Edit\Tabs\Form']);
        $this->setDefaultTab('shipment');
    }
}
