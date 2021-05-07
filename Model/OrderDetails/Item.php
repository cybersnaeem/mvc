<?php
namespace Model\OrderDetails;


class Item extends \Model\Core\Table
{
    public function __construct()
    {
        $this->setTableName('orderitems')->setPrimaryKey('orderItemId');
    }
}

?>