<?php

namespace Block\Admin\Product;

use Mage;
use Block\Core\Grid as CoreGrid;

class Grid extends CoreGrid
{

    protected $products = null;
    protected $filter = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/product/grid.php');
        $this->prepareColumns();
        $this->prepareActions();
        $this->prepareButtons();
        
    }

    public function setFilter($filter = null)
    {
        if (!$filter) {
            $filter = Mage::getModel('Model\Admin\Filter');
        }
        $this->filter = $filter;
        return $this;
    }

    public function getFilter()
    {
        if (!$this->filter) {
            $this->setFilter();
        }
        return $this->filter;
    }

    public function prepareColumns()
    {
        $this->addColumn(
            'SKU',
            [
                'field' => 'SKU',
                'label' => 'SKU',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'productName',
            [
                'field' => 'productName',
                'label' => 'Product Name',
                'type' => 'text'
            ]
        );
       
        $this->addColumn(
            'productPrice',
            [
                'field' => 'productPrice',
                'label' => 'Price',
                'type' => 'text'
            ]
        );

        $this->addColumn(
            'productDiscount',
            [
                'field' => 'productDiscount',
                'label' => 'Discount',
                'type' => 'text'
            ]
        );

        $this->addColumn(
            'productQty',
            [
                'field' => 'productQty',
                'label' => 'Quantity',
                'type' => 'text'
            ]
        );

        $this->addColumn(
            'status',
            [
                'field' => 'status',
                'label' => 'Status',
                'type' => 'text'
            ]
        );

        $this->addColumn(
            'createdDate',
            [
                'field' => 'createdDate',
                'label' => 'Created Date',
                'type' => 'text'
            ]
        );
    }
        
        
        public function prepareActions()
        {
            $this->addAction(
            'edit',
            [
                'label' => 'Edit',
                'class' => 'btn-floating waves-effect waves-light yellow',
                'method' => 'getEditUrl',
                'icon' => 'edit',
                'ajax' => true
            ]
        );
        
        $this->addAction(
            'delete',
            [
                'label' => 'Delete',
                'class' => 'btn-floating waves-effect waves-light red',
                'method' => 'getDeleteUrl',
                'icon' => 'delete',
                'ajax' => true
            ]
        );

            $this->addAction(
                'cart',
                [
                    'label' => 'Add To Cart',
                    'class' => 'btn-floating waves-effect waves-light orange',
                    'method' => 'getAddToCartUrl',
                    'icon' => 'local_grocery_store',
                    'ajax' => true

                ]
        );

        $this->addAction('changeStatus',[
            'label' => 'ChangeStatus',
            'class' => 'btn-floating waves-effect waves-light blue',
            'method' =>'getChangeStatusUrl',
            'icon' => 'gps_fixed',
            'ajax' => true
        ]);

        return $this;

        }
        
        public function prepareButtons()
        {
            $this->addButton(
                'addnew',
            [
                'label' => 'Add Product',
                'method' => 'getAddNewUrl',
                'icon' => 'add',
                'class' => 'material-icons right'
                ]
            );

            $this->addButton(
                'addfilter',
                [
                    'label' => 'Add Filter',
                    'method' => 'getaddFilterUrl',
                    'icon' => 'add',
                    'class' => 'material-icons right'
                ]
            );

            return $this;

        }

        public function getEditUrl($row)
        {
            $url = $this->getUrl()->getUrl('form','admin\product',['id'=>$row->productId]);
            return "mage.setUrl('{$url}').resetParam().load();";
        }
    
        public function getDeleteUrl($row)
        {
            $url = $this->getUrl()->getUrl('delete','admin\product',['id'=>$row->productId]);
            return "mage.setUrl('{$url}').resetParam().load();";
        }
    
        public function getaddNewUrl()
        {
            $url = $this->getUrl()->getUrl('form','admin\product',null);
            return "mage.setUrl('{$url}').resetParam().load();";
        }
    
        public function getaddFilterUrl()
        {
            $url = $this->getUrl()->getUrl('filter','admin\product',null);
            return "mage.setUrl('{$url}').resetParam().setForm('#filterData').load()";
        }
    
        public function getChangeStatusUrl($row)
        {
            $url = $this->getUrl()->getUrl('changeStatus','admin\product',['id'=>$row->productId,'status'=>$row->status]);
            return "mage.setUrl('{$url}').resetParam().load();";
        }

        public function getAddToCartUrl($row)
        {
            $url = $this->getUrl()->getUrl('addItemToCart','admin\cart', ['id' => $row->productId]);
            return "mage.setUrl('{$url}').resetParam().load();";
            //return $this->getUrl()->getUrl('addItemToCart','admin\cart', ['id' => $row->productId]);
        }

    public function setProducts($products = null)
    {
        if (!$products) {
            $products = \Mage::getModel("model\product");
            $products = $products->fetchAll();

        }
        $this->products = $products;
         return $this;
    }
    public function getProducts()
    {
        if (!$this->products) {
            $this->setProducts();
            
        }
        return $this->products;     
    }
    public function getTitle()
    {
        return "Manage Products";
    }


    public function getPaginationProducts()
    {
        $products = Mage::getModel("Model\Product");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }


        $query = "Select * from `product`";
        if ($this->getFilter()->hasFilters()) {
            $query .= " Where 1=1 ";
            foreach ($this->getFilter()->getFilters() as $type => $filters) {
                if ($type == 'text') {
                    foreach ($filters as $key => $value) {
                        $query .= "AND `{$key}` LIKE '%{$value}%'";
                    }
                }
            }
        }
        $query .= " LIMIT {$start},{$recordPerPage}";
        return $products->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `product`";
        if ($this->getFilter()->hasFilters()) {
            $query .= " Where 1=1 ";
            foreach ($this->getFilter()->getFilters() as $type => $filters) {
                if ($type == 'text') {
                    foreach ($filters as $key => $value) {
                        $query .= "AND `{$key}` LIKE '%{$value}%'";
                    }
                }
            }
        }

        $product = Mage::getModel('Model\Product');

        $records = $product->getAdapter()->fetchOne($query);

        $this->getPager()->setTotalRecords($records);
        $this->getPager()->setRecordPerPage(5);

        $page = $this->getRequest()->getGet('page');

        if (!$page) {
            $page = 1;
        }
        $this->getPager()->setCurrentPage($page);

        $this->getPager()->calculate();

        return $this;
    }

    
}

?>