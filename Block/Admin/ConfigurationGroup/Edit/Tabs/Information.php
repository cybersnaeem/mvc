<?php

namespace Block\Admin\ConfigurationGroup\Edit\Tabs;


class Information extends \Block\Core\Edit
{
    protected $configs = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/configurationGroup/edit/tabs/information.php");
    }

    public function setConfigGroup($configs = null)
    {
        if (!$configs) {
            $configs = \Mage::getModel("Model\ConfigurationGroup");
            if ($id = $this->getRequest()->getGet('id')) {
                $config = $configs->load($id);
                if (!$config) {
                    return null;
                }
            }
        }
        $this->configs = $configs;
        return $this;
    }

    public function getConfigGroup()
    {
        if (!$this->configs) {
            $this->setConfigGroup();
        }
        return $this->configs;
    }
}
