<?php

namespace Block\Admin\Payment;

use Mage;
use Block\Core\Grid as CoreGrid;

Mage::loadClassByFileName('Block\Core\Grid');
class Grid extends CoreGrid
{
    protected $payments = null;
    protected $filter = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/payment/grid.php');
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
            'name',
            [
                'field' => 'name',
                'label' => 'Name',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'code',
            [
                'field' => 'code',
                'label' => 'Code',
                'type' => 'text'
            ]
        );
       
        $this->addColumn(
            'amount',
            [
                'field' => 'amount',
                'label' => 'Amount',
                'type' => 'text'
            ]
        );

        $this->addColumn(
            'description',
            [
                'field' => 'description',
                'label' => 'Description',
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
                'label' => 'Add Payment',
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
            $url = $this->getUrl()->getUrl('form','admin\payment',['id'=>$row->methodId]);
            return "mage.setUrl('{$url}').resetParam().load();";
        }
    
        public function getDeleteUrl($row)
        {
            $url = $this->getUrl()->getUrl('delete','admin\payment',['id'=>$row->methodId]);
            return "mage.setUrl('{$url}').resetParam().load();";
        }
    
        public function getaddNewUrl()
        {
            $url = $this->getUrl()->getUrl('form','admin\payment',null);
            return "mage.setUrl('{$url}').resetParam().load();";
        }
    
        public function getaddFilterUrl()
        {
            $url = $this->getUrl()->getUrl('filter','admin\payment',null);
            return "mage.setUrl('{$url}').resetParam().setForm('#filterData').load()";
        }
    
        public function getChangeStatusUrl($row)
        {
            $url = $this->getUrl()->getUrl('changeStatus','admin\payment',['id'=>$row->methodId,'status'=>$row->status]);
            return "mage.setUrl('{$url}').resetParam().load();";
        }
    



    public function setPayments($payments = null)
    {
        if (!$payments) {
            $payments = \Mage::getModel("model\payment");
            $payments = $payments->fetchAll();
        }
        $this->payments = $payments;
        return $this;
    }
    public function getPayments()
    {
        if (!$this->payments) {
            $this->setPayments();
            
        }
        return $this->payments;     
    }
    public function getTitle()
    {
        return "Manage Payments";
    }

    public function getPaginationPayments()
    {
        $payments = Mage::getModel("Model\Payment");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }


        $query = "Select * from `payment`";
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
        return $payments->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `payment`";
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

        $payment = Mage::getModel('Model\Payment');

        $records = $payment->getAdapter()->fetchOne($query);

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