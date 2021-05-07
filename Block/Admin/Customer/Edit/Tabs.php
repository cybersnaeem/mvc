<?php

namespace Block\Admin\Customer\Edit;

class Tabs extends \Block\Core\Edit\Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/customer/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('customer',["label"=>"Customer Information","className"=>'Block\Admin\Customer\Edit\Tabs\Form']);
        if($this->getRequest()->getGet('id')){
            $this->addTab('customerAddress',["label"=>"Customer Address","className"=>'Block\Admin\Customer\Edit\Tabs\CustomerAddress']);
        }
        $this->setDefaultTab('customer');
    }   
}