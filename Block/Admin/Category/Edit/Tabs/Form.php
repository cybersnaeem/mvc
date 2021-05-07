<?php

namespace Block\Admin\Category\Edit\Tabs;

\Mage::loadClassByFileName("block\core\Template");

class Form extends \Block\Core\Template{
    protected $categories = null;
    protected $categoryOptions = [];
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/category/edit/tabs/form.php");
    }

    public function setCategory($categories = null)
    {
        if (!$categories)
        {
            $categories = \Mage::getModel("Model\category");
            if ($id = $this->getRequest()->getGet('id')) 
            {
                $category = $categories->load($id);
                if (!$category) {
                    return null;
                }
            }  
        }
        $this->categories = $categories;
        return $this;
    }
    public function getCategory()
    {
        if (!$this->categories) {
            $this->setCategory();
        }
        return $this->categories;     
    }  

    public function getFormUrl()
    {
        return $this->getUrl('category','save');
    }

    public function getCategoryOptions()
    {
        if (!$this->categoryOptions) 
        {
            $query = "SELECT `categoryId`,`categoryName` FROM `{$this->getCategory()->getTableName()}`;";
            $options = $this->getCategory()->getAdapter()->fetchPairs($query);

            $query = "SELECT `categoryId`,`pathId` FROM `{$this->getCategory()->getTableName()}`;";
            $this->categoryOptions = $this->getCategory()->getAdapter()->fetchPairs($query);
            
            if ($this->categoryOptions) {
                foreach ($this->categoryOptions as $categoryId => &$pathId) {
                    $pathIds = explode("/",$pathId);
                    foreach ($pathIds as $key => &$id) {
                        if (array_key_exists($id,$options)) {
                            $id = $options[$id];
                        }
                    }
                    $pathId = implode("=>",$pathIds);
                }
            }
            $this->categoryOptions = ["0"=>"Root"] + $this->categoryOptions;
        }
        return $this->categoryOptions;
    }
}