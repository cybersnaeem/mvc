<?php

namespace Model;

\Mage::loadClassByFileName("Model\Core\Table");

class CustomerGroup extends \Model\Core\Table{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('customer_group')->setPrimaryKey('group_id');
    }
}

?>