<?php

namespace Block\Core\Edit;

class Tabs extends \Block\Core\Template
{
    public function __construct()
    {
        parent::__construct();
    }

    public function setDefaultTab($key)
    {
        $this->default = $key;
        return $this;
    }

    public function getDefaultTab()
    {
        return $this->default;
    }

    public function setTabs(array $tabs)
    {
        $this->tabs = $tabs;
        return $this;
    }

    public function getTabs()
    {
        return $this->tabs;
    }

    public function addTab($key, $tabs = [])
    {

        $this->tabs[$key] = $tabs;
        return $this;
    }

    public function removeTab($key)
    {
        if (!array_key_exists($key, $this->tabs)) {
            return null;
        }
        unset($this->tabs[$key]);
        return $this;
    }

    public function getTab($key)
    {
        if (!array_key_exists($key, $this->tabs)) {
            return null;
        }
        return $this->tabs[$key];
    }

    public function getTableRow()
	{
		return $this->tableRow;
	}

	public function setTableRow(\Model\Core\Table $tableRow)
	{
		$this->tableRow = $tableRow;
		return $this;
	}
}
