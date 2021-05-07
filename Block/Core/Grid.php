<?php

namespace Block\Core;

use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class Grid extends \Block\Core\Template
{
    protected $columns = [];
    protected $action = [];
    protected $button = [];
    protected $message = null;

    public function __construct()
    {
        parent::__construct();
    }


    public function getFieldValue($row, $field)
    {
        if ($field == "status") {
            if ($row->$field) {
                return 'Enabled';
            } else {
                return 'Disabled';
            }
        }
        return $row->$field;
    }

    public function addColumn($key, $value)
    {
        $this->columns[$key] = $value;
        return $this;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function getActions()
    {
        return $this->action;
    }

    public function addAction($key, $value)
    {
        $this->action[$key] = $value;
        return $this;
    }

    public function getMethodUrl($row, $methodName)
    {
        return $this->$methodName($row);
    }

    public function getButton()
    {
        return $this->button;
    }

    public function addButton($key, $value)
    {
        $this->button[$key] = $value;
        return $this;
    }

    public function getButtonUrl($methodName)
    {
        return $this->$methodName();
    }

    public function getAddNewUrl()
    {
        return $this->getUrl()->getUrl('form');
    }
}
