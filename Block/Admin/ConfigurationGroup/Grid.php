<?php

namespace Block\Admin\ConfigurationGroup;

use Mage;

use Block\Core\Grid as CoreGrid;


class Grid extends CoreGrid
{

    protected $configs = null;
    protected $filter = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/configurationgroup/grid.php');
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
            'groupId',
            [
                'field'=>'groupId',
                'label'=>'Group Id',
                'type'=>'text'
            ]
        );

        $this->addColumn(
            'name',
            [
                'field'=> 'name',
                'label'=>'Name',
                'type'=>'text'
            ]
        );

        $this->addColumn(
            'createdDate',
            [
                'field'=>'createdDate',
                'label'=>'Created Date',
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
    }

    public function prepareButtons()
    {
        $this->addButton(
            'addnew',
            [
            'label' => 'Add Configuration Group',
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
        $url = $this->getUrl()->getUrl('form','admin\ConfigurationGroup',['id'=>$row->groupId]);
		return "mage.setUrl('{$url}').resetParam().load();";
    }

    public function getDeleteUrl($row)
    {
        $url = $this->getUrl()->getUrl('delete','admin\ConfigurationGroup',['id'=>$row->groupId]);
		return "mage.setUrl('{$url}').resetParam().load();";
    }

    public function getaddNewUrl()
	{
		$url = $this->getUrl()->getUrl('form','admin\ConfigurationGroup',null);
		return "mage.setUrl('{$url}').resetParam().load();";
    }

    public function getaddFilterUrl()
	{
        $url = $this->getUrl()->getUrl('filter','admin\ConfigurationGroup',null);
		return "mage.setUrl('{$url}').resetParam().setForm('#filterData').load()";
    }

    public function setConfigGroup($configs = null)
    {
        if (!$configs) {
            $configs = Mage::getModel("Model\Config");
            $configs = $configs->fetchAll();
        }
        $this->configs = $configs;
        return $this;
    }
    public function getConfigGroup()
    {
        if (!$this->configs) {
            $this->setConfigGroup();
        }
        return $this->configs;
    }
    public function getTitle()
    {
        return "Manage Configuration Group";
    }

    public function getPaginationConfigGroup()
    {
        $configs = Mage::getModel("Model\ConfigurationGroup");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }
        
        $query = "Select * from `config_group`";
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
        return $configs->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `config_group`";
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

        $config = Mage::getModel('Model\ConfigurationGroup');

        $records = $config->getAdapter()->fetchOne($query);

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
