<?php

namespace Block\Admin\Payment\Edit;

class Tabs extends \Block\Core\Edit\Tabs
{

    protected $tabs = [];
    protected $default = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/payment/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('payment', ["label" => "Payment Information", "className" => 'Block\Admin\Payment\Edit\Tabs\Form']);
        $this->setDefaultTab('payment');
    }
}
