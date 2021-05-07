<?php

namespace Block\Admin\OrderDetails;

use Mage;
use Block\Core\Grid as CoreGrid;

class Grid extends CoreGrid
{
    protected $orderDetails = null;
    protected $filter = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/orderDetails/grid.php');
        $this->prepareColumns();  
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
            'contactNo',
            [
                'field' => 'contactNo',
                'label' => 'Contact',
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
            'total',
            [
                'field' => 'total',
                'label' => 'Total',
                'type' => 'text'
            ]
        );

        $this->addColumn(
            'discount',
            [
                'field' => 'discount',
                'label' => 'Discount',
                'type' => 'text'
            ]
        );

        $this->addColumn(
            'paymentName',
            [
                'field' => 'paymentName',
                'label' => 'Payment Name',
                'type' => 'text'
            ]
        );

        $this->addColumn(
            'paymentMethodCode',
            [
                'field' => 'paymentMethodCode',
                'label' => 'payment Code',
                'type' => 'text'
            ]
        );

        $this->addColumn(
            'shippingName',
            [
                'field' => 'shippingName',
                'label' => 'Shipping Name',
                'type' => 'text'
            ]
        );

        $this->addColumn(
            'shippingMethodCode',
            [
                'field' => 'shippingMethodCode',
                'label' => 'Shipping Code',
                'type' => 'text'
            ]
        );

        $this->addColumn(
            'shippingMethodAmount',
            [
                'field' => 'shippingMethodAmount',
                'label' => 'Shipping Amount',
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
    
  


    public function setOrderDetails($orderDetails = null)
    {
        if (!$orderDetails) {
            $orderDetails = \Mage::getModel("model\orderDetails");
            $orderDetails = $orderDetails->fetchAll();
        }
        $this->orderDetails = $orderDetails;
        return $this;
    }
    public function getOrderDetails()
    {
        if (!$this->orderDetails) {
            $this->setOrderDetails();
        }
        return $this->orderDetails;     
    }
    public function getTitle()
    {
        return "Manage Order Details";
    }

    public function getPaginationOrderDetails()
    {
        $orderDetails = Mage::getModel("Model\OrderDetails");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }


        $query = "Select * from `orderdetails`";
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
        return $orderDetails->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `orderdetails`";
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

        $orderDetail = Mage::getModel('Model\OrderDetails');

        $records = $orderDetail->getAdapter()->fetchOne($query);

        $this->getPager()->setTotalRecords($records);
        $this->getPager()->setRecordPerPage(3);

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