<?php
namespace Model\Core;
class Adapter 
{
	public $config = [
		 'host'=>'localhost',
		 'user'=> 'root',
		 'password'=>'root',
		 'dbName' => 'cybercomproject'
	];
	private $connect = null;
	public $query = null;

	function connection()
	{
	    $connect = new \mysqli($this->config['host'], $this->config['user'], $this->config['password'], $this->config['dbName']);
		$this->setConnect($connect);
		return $this;
	}

	function getConnect() {
		return $this->connect;
	}

	function setConnect(\mysqli $connect) {
		$this->connect = $connect;
		return $this;
	}
	
	function isConnected() {
		if (!$this->getConnect()) {
			return false;
		}
		return true;
	}
	
	function fetchRow($query) {
		if (!$this->isConnected()) {
			$this->connection();
		}
		$result = $this->getConnect()->query($query);
		if(@mysqli_num_rows($result) == 0){
			return false;
		}
		$row = $result->fetch_assoc();
		return $row;
	
	}

	function fetchAll($query) {
		if (!$this->isConnected()) {
			$this->connection();
		}
		$result = $this->getConnect()->query($query);
		$rows = $result->fetch_all(MYSQLI_ASSOC);
		if (!$rows) {
			return false;
		}
		return $rows;
	}

	public function fetchPairs($query){
		if(!$this->isConnected()){
			$this->connection();
		}
		$res = $this->getConnect()->query($query);
		$rows = $res->fetch_all();
		if(!$rows){
			return $rows;
		}
		$columns = array_column($rows,'0');
		$values = array_column($rows,'1');
		return array_combine($columns,$values);
	}
	
	function insert($query) {
	    if (!$this->isConnected()) {
            $this->connection();
        } 
		$result = $this->getConnect()->query($query);
		if (!$result) {
            return $this->getConnect()->error;
        }
         return $this->getConnect()->insert_id;
        
	}
	
    public function update($query)
    {
        if (!$this->isConnected()) {
            $this->connection();
        }
        $result = $this->getConnect()->query($query);

        if (!$result) {
            return false;
        }
        return true;
    }

	
    public function delete($query){
        if(!$this->isConnected()){
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        if(!$result){
            return false;
        }
        return true;
    }

	public function alterTable($query){
		if(!$this->isConnected()){
			$this->connection();
		}
		$result = $this->getConnect()->query($query);
		if(!$result){
			return $this->getConnect()->error;
		}
		return true;
	}
}
?>

