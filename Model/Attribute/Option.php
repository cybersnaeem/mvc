<?php

namespace Model\Attribute;

\Mage::loadClassByFileName("Model\Core\Table");

class Option extends \Model\Core\Table
{
    protected $attribute = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('attribute_option')->setPrimaryKey('optionId');
    }

    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
        return $this;
    }

    public function getAttribute()
    {
        return $this->attribute;
    }
    
    public function getOption()
    {
        try {
            if(!$this->getAttribute()->attributeId){
                throw new \Exception("AttributeId Not Found", 1);
            }    
            $query = "SELECT * FROM `attribute_option` WHERE `attributeId` = '{$this->getAttribute()->attributeId}' ORDER BY `sortOrder` ASC";
            $option = \Mage::getModel('Model\Attribute\Option')->fetchAll($query);
            if(!$option){
                return null;
            }
            return $option;

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }
}
