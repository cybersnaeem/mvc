<?php

namespace Block\Admin\ConfigurationGroup\Edit\Tabs;

class Config extends \Block\Core\Edit
{
    protected $configs = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/configurationGroup/edit/tabs/config.php");
    }

    public function setConfig($configs = null)
    {
        if (!$configs) {
            $configs = \Mage::getModel("Model\ConfigurationGroup\Config");
            if ($id = $this->getRequest()->getGet('id')) {
                $query = "select * from `config` where groupId='{$id}'";
                $configs = $configs->fetchAll($query);
                if (!$configs) {
                    return $this;
                }
            }
        }
        $this->configs = $configs;
        return $this;
    }

    public function getConfig()
    {
        if (!$this->configs) {
            $this->setConfig();
        }
        return $this->configs;
    }
}
