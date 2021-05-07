<?php

namespace Block\Admin\Cms\Edit;

class Tabs extends \Block\Core\Edit\Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/cms/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('cms', ["label" => "CMS Information", "className" => 'Block\Admin\Cms\Edit\Tabs\Form']);
        $this->setDefaultTab('cms');
    }
}
