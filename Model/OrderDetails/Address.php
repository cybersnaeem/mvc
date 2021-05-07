<?php

namespace Model\OrderDetails;

class Address extends \Model\Core\Table
{
    public function __construct()
    {
        $this->setTableName('orderaddress')->setPrimaryKey('orderAddressId');
    }
}

?>