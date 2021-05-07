<?php

namespace Block\Admin\Product\Edit\Tabs;


class Category extends \Block\Core\Edit
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/product/edit/tabs/category.php");
    }

    public function getCategory()
    {
        $categoryModel = \Mage::getModel('Model\Category');

        $query = "select `categoryId`,`categoryName` from `category`";
        return $this->categoryOptions = $categoryModel->fetchAll($query);
    }


    public function checkCategory($id)
    {
        $productId = $this->getRequest()->getGet('id');
        $productModel = \Mage::getModel('Model\Product');
        $query = "select `productId` from `product` where categoryId='{$id}' and productId={$productId}";

        $id = $productModel->getAdapter()->fetchRow($query);

        if ($id) {
            return true;
        }
        return false;
    }

}