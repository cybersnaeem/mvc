<?php

namespace Model\Brand;

use Mage;
use Model\Core\Table\Collection as CoreTableCollection;

Mage::loadClassByFileName('Model\Core\Table\Collection');

class Collection extends  \Model\Core\Table\Collection
{
    public function __construct()
    {
        parent::__construct();
    }
}
