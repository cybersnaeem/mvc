<?php

namespace Model;

\Mage::loadClassByFileName("Model\Core\Table");
class Customer extends \Model\Core\Table{

    public function __construct()
    {
        parent::__construct();
        $this->setTableName('customer')->setPrimaryKey('customerId');
    }

    public function getBillingAddress()
    {
        $query = "select * from `customer_address` where `addressType` = 'billing' and `customerId` = {$this->customerId}";
        $address = \Mage::getModel('Model\CustomerAddress')->fetchRow($query);
        return $address;
    }

    public function getShippingAddress()
    {
        $query = "select * from `customer_address` where `addressType` = 'shipping' and `customerId` = {$this->customerId}";
        $address = \Mage::getModel('Model\CustomerAddress')->fetchRow($query);
        return $address;
    }

}

?>