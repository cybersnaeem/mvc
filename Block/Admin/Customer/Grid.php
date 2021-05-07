<?php

namespace Block\Admin\Customer;

use Mage;
use Block\Core\Grid as CoreGrid;


class Grid extends CoreGrid
{

    protected $customers = null;
    protected $filter = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/customer/grid.php');  
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
            'firstName',
            [
                'field' => 'firstName',
                'label' => 'First Name',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'lastName',
            [
                'field' => 'lastName',
                'label' => 'Last Name',
                'type' => 'text'
            ]
        );
       
        $this->addColumn(
            'email',
            [
                'field' => 'email',
                'label' => 'Email',
                'type' => 'text'
            ]
        );


        $this->addColumn(
            'contactNo',
            [
                'field' => 'contactNo',
                'label' => 'Contact No',
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
                'changeStatus',
                [
                    'label' => 'ChangeStatus',
                    'class' => 'btn-floating waves-effect waves-light blue',
                    'method' =>'getChangeStatusUrl',
                    'icon' => 'gps_fixed',
                    'ajax' => true
                ]
            );

            return $this;
        }
        
        public function prepareButtons()
        {
            $this->addButton(
                'addnew',
            [
                'label' => 'Add Customer',
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
            $url = $this->getUrl()->getUrl('form','admin\customer',['id'=>$row->customerId]);
            return "mage.setUrl('{$url}').resetParam().load();";
        }
    
        public function getDeleteUrl($row)
        {
            $url = $this->getUrl()->getUrl('delete','admin\customer',['id'=>$row->customerId]);
            return "mage.setUrl('{$url}').resetParam().load();";
        }
    
        public function getaddNewUrl()
        {
            $url = $this->getUrl()->getUrl('form','admin\customer',null);
            return "mage.setUrl('{$url}').resetParam().load();";
        }
    
        public function getaddFilterUrl()
        {
            $url = $this->getUrl()->getUrl('filter','admin\customer',null);
            return "mage.setUrl('{$url}').resetParam().setForm('#filterData').load()";
        }
    
        public function getChangeStatusUrl($row)
        {
            $url = $this->getUrl()->getUrl('changeStatus','admin\customer',['id'=>$row->customerId,'status'=>$row->status]);
            return "mage.setUrl('{$url}').resetParam().load();";
        }


    public function getGroupName($id)
    {
        $customers = Mage::getModel("model\customerGroup");
        $data = $customers->load($id);
        
        return $data->name;
    }


    public function setCustomers($customers = null)
    {
        if (!$customers) {
            $customers = Mage::getModel("model\customer");
            $customers = $customers->fetchAll();
        }
        $this->customers = $customers;
        return $this;
    }
    public function getCustomers()
    {
        if (!$this->customers) {
            $this->setCustomers();
            
        }
        return $this->customers;     
    }
    public function getTitle()
    {
        return "Manage Customers";
    }

    public function getZipCode($id)
    {
        $zipcode = Mage::getModel("Model\CustomerAddress");
        $query = "select `zipcode` from `customer_address` where `addressType`='Billing' and `customerId`={$id}";

        $data = $zipcode->getAdapter()->fetchRow($query);

        return $data ? $data['zipcode'] : "No Billing Zip Found";
    }

    public function getPaginationCustomers()
    {
        $customer = Mage::getModel("Model\Customer");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }


        $query = "Select * from `customer`";
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
        return $customer->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `customer`";
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

        $customer = Mage::getModel('Model\Customer');

        $records = $customer->getAdapter()->fetchOne($query);

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


