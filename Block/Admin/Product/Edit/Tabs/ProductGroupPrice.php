<?php
namespace Block\Admin\Product\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Template');
class ProductGroupPrice extends \Block\Core\Template{

 //protected $product = null;
 protected $tableRow = null;
 protected $customerGroups = [];

 public function __construct()
 {
     $this-> setTemplate('./View/admin/product/edit/tabs/product_group_price.php');
 }

//  public function setProduct(\Model\Product $product){
//      $this->product = $product;
//      return $this;
//  }

//  public function getProduct(){
//      return $this->product;
//  }
public function setTableRow(\Model\Product $tableRow){
    $this->tableRow = $tableRow;
    return $this;
}

public function getTableRow(){
    return $this->tableRow;
}

 public function getCustomerGroup(){
     $query = "SELECT cg.*,pgp.ProductId,pgp.entityId,pgp.price as groupPrice,
     if(p.price Is NULL,'{$this->getTableRow()->price}',p.price) as price
     FROM customergroup cg
     LEFT JOIN productgroupprice pgp
        ON pgp.customerGroupId = cg.groupId
            AND pgp.productId = '{$this->getTableRow()->productId}'
     LEFT JOIN product p
        ON pgp.productId = p.productId";
     $customerGroups = \Mage::getModel('Model\Customer\CustomerGroup');
     $this->customerGroups = $customerGroups->fetchAll($query);

     return $this->customerGroups;
 }
}

?>