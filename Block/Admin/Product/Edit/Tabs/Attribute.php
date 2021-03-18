<?php

namespace Block\Admin\Product\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Template');

class Attribute extends \Block\Core\Template{

 protected $tableRow = null;
 protected $productAttribute = null;
 protected $attributeOptions = null;
 protected $attribute = null;

 public function __construct()
 {
     parent::__construct();
     $this-> setTemplate('./View/admin/product/edit/tabs/attribute.php');
 }

 public function setTableRow(\Model\Product $tableRow){
    $this->tableRow = $tableRow;
    return $this;
}

 public function getTableRow(){
    return $this->tableRow;
 }

    public function setAttribute($attribute = null){
        if(!$attribute){
            $attribute = \Mage::getModel('Model\Attribute');
        }
        $this->attribute = $attribute;
        return $this;
    }

    public function getAttribute(){
        if(!$this->attribute){
            $this->setAttribute();
        }
        return $this->attribute;
    }

public function getProductAttribute(){
    $query = "SELECT * from `{$this->getAttribute()->getTableName()}` where `entityTypeId` = 'product' order by `sortOrder`";
    return $this->getAttribute()->fetchAll($query);
}

}

?>