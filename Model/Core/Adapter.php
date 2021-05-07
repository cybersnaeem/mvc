<?php

namespace Model\Core;
use \mysqli;

class Adapter{

	private $config=[
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'database' => 'questdb'

	];
	private $connect=null;
	public function connection(){
			$connect=new mysqli($this->config['host'],$this->config['username'],$this->config['password'],$this->config['database']);
			$this->setConnect($connect);
			if(!$connect){
				return false;
			}
			return true;
	}
	public function getConnect(){
		return $this->connect;
	}
	public function setConnect(mysqli $connect){

		$this->connect=$connect;
		return $this;
	}
	public function isConnected(){
			if(!$this->getConnect()){
				
				return false;
			}
			return true;
		}

	public function fetchAll($query){
			if(!$this->isConnected()){
				$this->connection();

			}
			 $result=mysqli_query($this->getConnect(),$query);
			if($result->num_rows > 0){
					$data=[];
					while ($row=$result->fetch_assoc()) {
						$data[]=$row;
						}
				return $data;
			}
	}
	public function fetchRow($query)
    {
        if(!$this->isConnected()){
            $this->connection();
        }
            $result = mysqli_query($this->getConnect(), $query);
            if ($result->num_rows > 0) {

                return  $result->fetch_assoc();
            }
    }
	public function insert($query){

		if (!$this->isConnected()) {
            $this->connection();
        }
			$result=mysqli_query($this->getConnect(),$query);
			if($result > 0){
				return $this->getConnect()->insert_id;
			}
			return false;

	}
	public function update($query)
    {
		if (!$this->isConnected()) {
            $this->connection();
        }
        $result = mysqli_query($this->getConnect(), $query);
        if($result > 0){
            return true;
        }
		return false;
    }
	public function delete($query)
    {
		if (!$this->isConnected()) {
            $this->connection();
        }
        $result = mysqli_query($this->getConnect(), $query);
        if($result > 0){
            return true;
        }
		return false;
    }
	
	public function fetchPairs($query){
		if(!$this->isConnected()){
			$this->connection();

		}
		$result=mysqli_query($this->getConnect(),$query);
		$rows = $result->fetch_all();
	
		if(!$rows){
			return $rows;
		}
		$columns = array_column($rows, "0");
		$values = array_column($rows, "1");

		return array_combine($columns,$values);
	}

	public function alterTable($query)
	{
		if (!$this->isConnected()) {
			$this->connection();
		}
		$result = mysqli_query($this->getConnect(), $query);

		if (mysqli_error($this->getConnect())) {
			return false;
		}
		return true;
	}

	public function fetchOne($query)
	{
		if (!$this->isConnected()) {
			$this->connection();
		}
		$result = $this->getConnect()->query($query);

		return  $result->num_rows;
	}
	
	public function getEscapeSequence($string)
	{
		return mysqli_real_escape_string($this->getConnect(), $string);
	}
}

?>