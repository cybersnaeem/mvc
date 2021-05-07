<?php

namespace Model\Admin;

use Mage;

Mage::loadClassByFileName('Model\Core\Table');

class Filter extends \Model\Core\Table
{
    protected $filters = [];
    public function __construct()
    {
    }

    public function setFilters($filters)
    {
        if (!$filters) {
            return false;
        }

        $filters = array_filter(array_map(function ($value) {
            $value = array_filter(($value));
            return $value;
        }, $filters));

        $this->filters = $filters;
    }

    public function getFilters()
    {
        return $this->filters;
    }

    public function hasFilters()
    {
        if (!$this->filters) {
            return false;
        }
        return true;
    }

    public function getFilterValue($type, $key)
    {
        if (!$this->getFilters()) {
            return null;
        }

        if (!array_key_exists($type, $this->getFilters())) {
            return null;
        }

        if (!array_key_exists($key, $this->getFilters()[$type])) {
            return null;
        }

        return $this->filters[$type][$key];
    }
}
