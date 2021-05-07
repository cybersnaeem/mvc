<?php

namespace Model\ConfigurationGroup;

\Mage::loadClassByFileName("Model\Core\Table");

class Config extends \Model\Core\Table
{
    protected $configurationGroup = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('config')->setPrimaryKey('configId');
    }

    public function setConfigurationGroup($configurationGroup)
    {
        $this->configurationGroup = $configurationGroup;
        return $this;
    }

    public function getConfigurationGroup()
    {
        return $this->configurationGroup;
    }
    
    public function getConfig()
    {
        try {
            if(!$this->getConfigurationGroup()->groupId){
                throw new \Exception("Group Id Not Found", 1);
            }    
            echo $query = "SELECT * FROM `config` WHERE `groupId` = '{$this->getConfigurationGroup()->groupId}'";
            $config = \Mage::getModel('Model\ConfigurationGroup\Config')->fetchAll($query);
            if(!$config){
                return null;
            }
            return $config;

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }
}
