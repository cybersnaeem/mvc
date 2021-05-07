<?php

namespace Block\Admin\Product\Edit;


class Tabs extends \Block\Core\Edit\Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/product/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('product',["label"=>"Product Information","className"=>'Block\Admin\Product\Edit\Tabs\Form']);
        if($this->getRequest()->getGet('id')){
            $this->addTab('media',["label"=>"Media","className"=>'Block\Admin\Product\Edit\Tabs\Media']);
            $this->addTab('attribute', ["label" => "Attribute", "className" => 'Block\Admin\Product\Edit\Tabs\Attribute']);
            $this->addTab('groupPrice',["label"=>"Group Price","className"=>'Block\Admin\Product\Edit\Tabs\GroupPrice']);
        }   
        $this->addTab('category',["label"=>"Category","className"=>'Block\Admin\Product\Edit\Tabs\Category']);
        $this->setDefaultTab('product');
    }
}