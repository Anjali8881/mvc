<?php
namespace Model\Core;

\Mage::loadFileByClassName('Model\Core\Adapter');
class Table{

    protected $adapter = null;
    protected $primaryKey = null;
    protected $tableName = null;
    public $data = [];

    public function setAdapter(){
        $this->adapter = \Mage::getModel('Model\Core\Adapter');
        return $this;
    }

    public function getAdapter(){
        if(!$this->adapter){
            $this->setAdapter();
        }
        return $this->adapter;
    }

    public function setPrimaryKey($primaryKey){
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getPrimaryKey(){
        return $this->primaryKey;
    }

    public function setData(array $data){
        $this->data = array_merge($this->data,$data);
        return $this;
    }

    public function getData(){
        return $this->data;
    }

    public function setTableName($tableName){
        $this->tableName = $tableName;
        return $this;
    }

    public function getTableName(){
        return $this->tableName;
    }

    public function __set($key,$value){
        $this->data[$key] = $value;
        return $this;
    }

    public function __get($key){
        if(!array_key_exists($key,$this->data)){
            return null;
        }
        return $this->data[$key];
    }

    public function save(){
        if(array_key_exists($this->getPrimaryKey(),$this->getData())){
            $keys = [];

            foreach($this->getData() as $key => $value){
                $keys[] = "`".$key."` = '".$value."'";
            }

            $id = $this->getData()[$this->getPrimaryKey()];
            array_shift($keys);
            $keys = implode(',',$keys);
            $query = "update `{$this->getTableName()}` set {$keys} where `{$this->getPrimaryKey()}` = {$id}";
            $this->getAdapter()->update($query);
        }
        else{
            $keys = implode(",",array_keys($this->getData()));
            $values = array_values($this->getData());
            for($i = 0 ; $i < count($values); $i++){
                $values[$i] = "'".$values[$i]."'";
            }

            $values = implode(",",$values);
            $query = "insert into `{$this->getTableName()}` ({$keys}) values ({$values})";
            $id =  $this->getAdapter()->insert($query);
        }
        $this->load($id);
        return $this;
         
    }

    public function load($value){
        $value = (int)$value;
        $query = "SELECT * from `{$this->getTableName()}` where `{$this->getPrimaryKey()}`='{$value}'";
        return $this->fetchRow($query);
    }

    public function fetchRow($query){
        $row = $this->getAdapter()->fetchRow($query);
        if(!$row){
            return false;
        }
        $this->data = $row;
        return $this;
    }

    public function delete(){
        
        $query = "DELETE FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` = '{$this->data[$this->getPrimaryKey()]}'";
        return $this->getAdapter()->delete($query);
    }

    public function fetchAll($sql = null){
        if(!$sql){
            $sql = "select * from `{$this->getTableName()}`"; 
        }
        $rows = $this->getAdapter()->fetchAll($sql);
        if(!$rows){
            return false;
        }
        foreach($rows as $key => &$value){
            $row = new $this;
            $value = $row->setData($value);
        }
        $collectionClassName = get_class($this).'\Collection';
        $collection = \Mage::getModel($collectionClassName);
        $collection->setData($rows);
        return $collection;
    }
    
    public function alterTable($query){
        return $this->getAdapter()->alterTable($query);
    }
}
?>