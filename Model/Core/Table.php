<?php

namespace Model\Core;

class Table {

    protected $adapter = null;
    protected $tableName = null;
    protected $primaryKey = null; 
    protected $originalData = [];
    protected $data =[];

    public function __construct()
    {
        $this->setTableName($this->tableName)->setPrimaryKey($this->primaryKey);
    }

    public function setOriginalData(array $originalData)
    {
        $this->originalData = $originalData;
        return $this;
    }

    public function getOriginalData()
    {
        return $this->originalData;
    }

    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
        return $this;
    }
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }
    public function getTableName()
    {
        return $this->tableName;
    }
    public function setAdapter()
    {
        $this->adapter = \Mage::getModel("model\core\adapter");
        return $this;
    }
    public function getAdapter()
    {
        if(!$this->adapter){
            $this->setAdapter();
        }
        return $this->adapter;
    }
    public function setData(array $data)
    {
        $this->data = array_merge($this->data,$data);
        return $this;
    }

    public function getData()
    {   
        return $this->data;
    }

    public function resetArray()
    {
        $this->data = [];
        return $this;
    }

    public function __set($name,$value)
    {
        $this->data[$name] = $value;
        return $this;
    }
    public function __get($name)
    {
        if(array_key_exists($name,$this->data)){
            return $this->data[$name];
        }

        if(array_key_exists($name,$this->originalData)){
            return $this->originalData[$name];
        }

        return null;
    }

    public function __unset($name)
    {
        if(array_key_exists($name,$this->data)){
            unset($this->data[$name]);
        }

        if(array_key_exists($name,$this->originalData)){
            unset($this->originalData[$name]);
        }

        return null;
    }

    
    public function fetchRow($query)
    {
        $row = $this->getAdapter()->fetchRow($query);
        if (!$row) {
            return false;
        }
        $this->setOriginalData($row);
        $this->resetArray();
        return $this;
    }

    public function save(){
       
        if(array_key_exists($this->getPrimaryKey(),$this->data)){
            unset($this->data[$this->getPrimaryKey()]);
        }

        $id = (int)$this->{$this->getPrimaryKey()};

        if(!$this->data){
            return false;
        }

        if (!$id) {

            $key = implode(',', array_keys($this->data)); 

            $values  = array_map(function($string) {
                                    return "'" . $string . "'";
                                }, array_values($this->data));

            $actual_value = implode(",",$values);
            
            $query = "insert into `{$this->getTableName()}`({$key}) VALUES ({$actual_value})";

            return $this->insert($query);
        }
        else{

            $value= array_values($this->data);
            $filed = array_keys($this->data);
            $final = null;

            

            for ($i=0; $i < count($filed); $i++) {
				if ($filed[$i] == $this->getPrimaryKey()) {
					$id = $value[$i];
					continue;
				}
				$final = $final."`".$filed[$i]."`='".$value[$i]."',";
			}
			$final = rtrim($final,",");
            
            $query ="UPDATE `{$this->getTableName()}` SET {$final} WHERE `{$this->getPrimaryKey()}` = '{$id}'";
            $this->update($query);
        }
    }
    
    public function fetchAll($query = null)
    {
        if(!$query){
            $query = "SELECT * FROM `{$this->getTableName()}`";    
        }
    	
        $rows = $this->getAdapter()->fetchAll($query);
        if (!$rows) {
        	return false;
        }
        foreach ($rows as $key => $value) {
        	$key = new $this;
        	$key->setData($value);
        	$rowArray[] = $key;
        }

        $collectionClassName = get_class($this).'\Collection'; 
        $collection = \Mage::getModel($collectionClassName);
        $collection->setData($rowArray);
        unset($rowArray);
        return $collection;
    }
   

    public function changeStatus(){
        $id = $this->data['id'];
        $st = $this->data['status'];
        if($st){
            $status = 0;
        }
        else{
            $status = 1;
        }
        
        $query = "UPDATE {$this->getTableName()} SET status={$status} where {$this->getPrimaryKey()}={$id}";
        
        $this->update($query);
    }
    public function load($value){

        $value = (int)$value;

        $query = "select * from `{$this->getTableName()}` where `{$this->getPrimaryKey()}` = {$value}";
        
        $row = $this->getAdapter()->fetchRow($query);
        if(!$row){
            return false;
        }

        $this->setOriginalData($row);
        $this->resetArray();
        return $this;
    }
    public function insert($query){
        $row = $this->getAdapter()->insert($query);
        
        if(!$row){
            echo false;
        }
        return $this;
    }
    public function update($query){
        
        $row = $this->getAdapter()->update($query);
        if(!$row){
            return false;
        }
        return $this;
    }
    public function delete($query = null){

        if(!$query){
            $id = $this->getData()[$this->getPrimaryKey()];
            $query = "delete from {$this->getTableName()} where {$this->getPrimaryKey()} = {$id}";
        }
    
        $row = $this->getAdapter()->delete($query);
        if(!$row){
            return false; 
        }
       return $this;
    }

    public function alterTable($query)
    {
        if (!$query) {
            return false;
        }

        $row = $this->getAdapter()->alterTable($query);
        if (!$row) {
            return false;
        }
        return $this;
    }
}


?>