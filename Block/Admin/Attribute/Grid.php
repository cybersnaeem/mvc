<?php

namespace Block\Admin\Attribute;

use Mage;

use Block\Core\Grid as CoreGrid;


class Grid extends CoreGrid
{

    protected $attributes = null;
    protected $filter = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/attribute/grid.php');
        $this->prepareColumn();
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

    public function prepareColumn()
    {
        $this->addColumn(
            'AttributeId',
            [
                'field'=>'attributeId',
                'label'=>'Attribute Id',
                'type'=>'text'
            ]
        );

        $this->addColumn(
            'name',
            [
                'field'=> 'name',
                'label'=>'Attribute Name',
                'type'=>'text'
            ]
        );

        $this->addColumn(
            'entityTypeId',
            [
                'field'=>'entityTypeId',
                'label'=>'Entity Type Id',
                'type'=>'text'
            ]
        );

        $this->addColumn(
            'code',
            [
                'field'=>'code',
                'label'=>'Code',
                'type'=>'text'
            ]
        );

        $this->addColumn(
            'inputType',
            [
                'field'=>'inputType',
                'label'=>'Input Type',
                'type'=>'text'
            ]
        );

        $this->addColumn(
            'backendType',
            [
                'field'=>'backendType',
                'label'=>'Backend Type',
                'type'=>'text'
            ]
        );

        $this->addColumn(
            'sortOrder',
            [
                'field'=>'sortOrder',
                'label'=>'Sort Order',
                'type'=>'text'
            ]
        );

        $this->addColumn(
            'backendModel',
            [
                'field'=>'backendModel',
                'label'=>'Backend Model',
                'type'=>'text'
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

    return $this;
    }

    public function prepareButtons()
    {
        $this->addButton(
            'addnew',
            [
                'label' => 'Add Attribute',
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
        $url = $this->getUrl()->getUrl('form','admin\attribute',['id'=>$row->attributeId]);
		return "mage.setUrl('{$url}').resetParam().load();";
    }

    public function getDeleteUrl($row)
    {
        $url = $this->getUrl()->getUrl('delete','admin\attribute',['id'=>$row->attributeId]);
		return "mage.setUrl('{$url}').resetParam().load();";
    }

    public function getaddNewUrl()
	{
		$url = $this->getUrl()->getUrl('form','admin\attribute',null);
		return "mage.setUrl('{$url}').resetParam().load();";
    }

    public function getaddFilterUrl()
	{
        $url = $this->getUrl()->getUrl('filter','admin\attribute',null);
		return "mage.setUrl('{$url}').resetParam().setForm('#filterData').load()";
    }

    public function setAttributes($attributes = null)
    {
        if (!$attributes) {
            $attributes = Mage::getModel("Model\Attribute");
            $attributes = $attributes->fetchAll();
        }
        $this->attributes = $attributes;
        return $this;
    }
    public function getAttributes()
    {
        if (!$this->attributes) {
            $this->setAttributes();
        }
        return $this->attributes;
    }
    public function getTitle()
    {
        return "Manage Attributes";
    }

    public function getPaginationAttributes()
    {
        $attributes = Mage::getModel("Model\Attribute");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }
        
        $query = "Select * from `attribute`";
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
        return $attributes->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `attribute`";
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

        $attribute = Mage::getModel('Model\Attribute');

        $records = $attribute->getAdapter()->fetchOne($query);

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
