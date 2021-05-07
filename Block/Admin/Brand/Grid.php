<?php


namespace Block\Admin\Brand;

use Mage;
use Block\Core\Grid as CoreGrid;


class Grid extends CoreGrid
{

    protected $brands = null;
    protected $filter = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/brand/grid.php');
        $this->prepareButtons();
        $this->prepareColumns();
        $this->prepareActions();
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
            'name',
            [
                'field' => 'name',
                'label' => 'Brand Name',
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
                    'label' => 'Add Brand',
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
            $url = $this->getUrl()->getUrl('form','admin\brand',['id'=>$row->brandId]);
            return "mage.setUrl('{$url}').resetParam().load();";
        }
    
        public function getDeleteUrl($row)
        {
            $url = $this->getUrl()->getUrl('delete','admin\brand',['id'=>$row->brandId]);
            return "mage.setUrl('{$url}').resetParam().load();";
        }
    
        public function getaddNewUrl()
        {
            $url = $this->getUrl()->getUrl('form','admin\brand',null);
            return "mage.setUrl('{$url}').resetParam().load();";
        }
    
        public function getaddFilterUrl()
        {
            $url = $this->getUrl()->getUrl('filter','admin\brand',null);
            return "mage.setUrl('{$url}').resetParam().setForm('#filterData').load()";
        }
    
        public function getChangeStatusUrl($row)
        {
            $url = $this->getUrl()->getUrl('changeStatus','admin\brand',['id'=>$row->brandId,'status'=>$row->status]);
            return "mage.setUrl('{$url}').resetParam().load();";
        }


    public function setBrands($brands = null)
    {
        if (!$brands) {
            $brands = Mage::getModel("Model\Brand");
            $brands = $brands->fetchAll();
        }
        $this->brands = $brands;
        return $this;
    }
    public function getBrands()
    {
        if (!$this->brands) {
            $this->setBrands();
        }
        return $this->brands;
    }
    public function getTitle()
    {
        return "Manage Brands";
    }

    public function getPaginationBrands()
    {
        $brands = Mage::getModel("Model\Brand");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }


        $query = "Select * from `brand`";
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
        return $brands->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `brand`";
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

        $brand = Mage::getModel('Model\Brand');

        $records = $brand->getAdapter()->fetchOne($query);

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
