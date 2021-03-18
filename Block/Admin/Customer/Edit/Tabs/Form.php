<?php
namespace Block\Admin\Customer\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Template');
class Form extends \Block\Core\Template{

    //protected $customer = null;
    protected $tableRow = null;
    
    public function __construct()
    {
        parent::__construct();
        $this-> setTemplate('./View/admin/customer/edit/tabs/form.php');
    }

    // public function setCustomer($customer = null){
    //     if($customer){
    //         $this->customer = $customer;
    //         return $this;
    //     }
    //     $customer = \Mage::getModel('Model\Customer');
    //     if($id = $this->getRequest()->getGet('id')){
    //         $customer = $customer->load($id);
    //     }
    //     $this->customer = $customer;
    //     return $this;
    // }

    // public function getCustomer(){
    //     if(!$this->customer){
    //         $this->setCustomer();
    //     }
    //     return $this->customer;
    // }

    public function customerGroup(){
        $customerGroup = \Mage::getModel('Model\Customer\CustomerGroup');
        $query = "Select * from `customerGroup`";
        return $customerGroup->fetchAll($query);
    }

    public function setTableRow(\Model\Customer $tableRow){
        $this->tableRow = $tableRow;
        return $this;
    }

    public function getTableRow(){
        return $this->tableRow;
    }

}

?>