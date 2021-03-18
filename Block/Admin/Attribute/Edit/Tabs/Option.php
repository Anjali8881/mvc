<?php
namespace Block\Admin\Attribute\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Template');

class Option extends \Block\Core\Template{

 //protected $attribute = null;
 protected $tableRow = null;
 
 public function __construct()
 {
     parent::__construct();
     $this-> setTemplate('./View/admin/attribute/edit/tabs/option.php');
 }

 public function setTableRow(\Model\Attribute $tableRow){
    $this->tableRow = $tableRow;
    return $this;
}

public function getTableRow(){
    return $this->tableRow;
}

}

?>