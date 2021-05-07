<?php

namespace Model;

\Mage::loadClassByFileName("Model\Core\Table");

class Media extends \Model\Core\Table{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('productgallery')->setPrimaryKey('producGalleryId');
    }
}

?>