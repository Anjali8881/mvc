<?php
namespace Block\Admin\ShippingMethod\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Template');

class Form extends \Block\Core\Template{

    // protected $shippingMethod = null;
    protected $tableRow = null;
    
    public function __construct()
    {
        parent::__construct();
        $this-> setTemplate('./View/admin/shippingMethod/edit/tabs/form.php');
    }

    // public function setShippingMethods($shippingMethod = null){
    //     if($shippingMethod){
    //         $this->shippingMethod = $shippingMethod;
    //         return $this;
    //     }
    //     $shippingMethod = \Mage::getModel('Model\ShippingMethod');
    //     if($id = $this->getRequest()->getGet('id')){
    //         $shippingMethod = $shippingMethod->load($id);
    //     }
    //     $this->shippingMethod = $shippingMethod;
    //     return $this;
    // }

    // public function getShippingMethods(){
    //     if(!$this->shippingMethod){
    //         $this->setShippingMethods();
    //     }
    //     return $this->shippingMethod;
    // }

    public function setTableRow(\Model\ShippingMethod $tableRow){
        $this->tableRow = $tableRow;
        return $this;
    }

    public function getTableRow(){
        return $this->tableRow;
    }

}

?>