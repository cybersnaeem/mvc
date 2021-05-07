<?php

namespace Model;

\Mage::loadClassByFileName("Model\Core\Table");
class Category extends \Model\Core\Table{
    
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('category')->setPrimaryKey('categoryId');
    }


    public function updateChildernPathIds($categoryPathId, $parentId = null)
    {
        $categoryPathId = $categoryPathId."/";
        echo $query = "SELECT * FROM `{$this->getTableName()}` WHERE `pathId` LIKE '{$categoryPathId}%' ORDER BY `pathId` ASC";
        $categories = $this->getAdapter()->fetchAll($query);
        if ($categories) {
            foreach ($categories as $key => $row) 
            {
                $row = $this->load($row['categoryId']);
                if ($parentId != null) {
                    $row->parentId = $parentId;
                }
                $row->updatePathId();  
            }
        }
    }  
}

?>