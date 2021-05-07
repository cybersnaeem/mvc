<?php

namespace Block\Admin\Cms\Edit\Tabs;

class Form extends \Block\Core\Edit
{
    protected $cmsies = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/cms/edit/tabs/form.php");
    }

    public function setCms($cmsies = null)
    {
        if (!$cmsies) {
            $cmsies = \Mage::getModel("Model\Cms");
            if ($id = $this->getRequest()->getGet('id')) {
                $cms = $cmsies->load($id);
                if (!$cms) {
                    return null;
                }
            }
        }
        $this->cmsies = $cmsies;
        return $this;
    }

    public function getCms()
    {
        if (!$this->cmsies) {
            $this->setCms();
        }
        return $this->cmsies;
    }
}
