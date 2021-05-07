<?php
namespace Model;

class ConfigurationGroup extends \Model\Core\Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('config_group')->setPrimaryKey('groupId');
    }

}
