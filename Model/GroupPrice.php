<?php

namespace Model;

\Mage::loadClassByFileName("Model\Core\Table");

class GroupPrice extends \Model\Core\Table{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('product_group_price')->setPrimaryKey('entityId');
    }
}

?>