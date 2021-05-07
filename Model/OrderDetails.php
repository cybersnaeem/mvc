<?php

namespace Model;

class OrderDetails extends \Model\Core\Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('orderdetails')->setPrimaryKey('orderId');
    }
}

?>