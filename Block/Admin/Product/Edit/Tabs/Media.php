<?php

namespace Block\Admin\Product\Edit\Tabs;


class Media extends \Block\Core\Edit
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/product/Edit/Tabs/media.php");
    }

    public function getImageData($id)
    {
        $mediaModel = \Mage::getModel("model\media");
        $query = "select * from productgallery where productId =".$id;
        $media = $mediaModel->fetchAll($query);
        return $media;
    }

}