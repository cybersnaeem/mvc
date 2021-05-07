<?php

namespace Model\Core\Table;

class Collection {
    //protected $originalData = [];
    protected $data = [];

    public function __construct()
    {
        
    }

    // public function setOriginalData(array $originalData)
    // {
    //     $this->originalData = $originalData;
    //     return $this;
    // }

    // public function getOriginalData()
    // {
    //     return $this->originalData;
    // }

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function count()
    {
        return count($this->data);
    }
}

?>