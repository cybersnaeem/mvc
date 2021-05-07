<?php

namespace Model;

\Mage::loadClassByFileName("Model\Core\Table");

class Shipment extends \Model\Core\Table{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('shipping')->setPrimaryKey('methodId');
    }
}

?>