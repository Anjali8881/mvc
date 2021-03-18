<?php
namespace Block\Admin\Customer\CustomerGroup\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Template');
class Form extends \Block\Core\Template{

    //protected $customerGroup = null;
    protected $tableRow = null;
    
    public function __construct()
    {
        parent::__construct();
        $this-> setTemplate('./View/admin/customer/customer_group/edit/tabs/form.php');
    }

    // public function setCustomerGroup($customerGroup = null){
    //     if($customerGroup){
    //         $this->customerGroup = $customerGroup;
    //         return $this;
    //     }
    //     $customerGroup = \Mage::getModel('Model\Customer\CustomerGroup');
    //     if($id = $this->getRequest()->getGet('id')){
    //         $customerGroup = $customerGroup->load($id);
    //     }
    //     $this->customerGroup = $customerGroup;
    //     return $this;
    // }

    // public function getCustomerGroup(){
    //     if(!$this->customerGroup){
    //         $this->setCustomerGroup();
    //     }
    //     return $this->customerGroup;
    // }

    public function setTableRow(\Model\Customer\CustomerGroup $tableRow){
        $this->tableRow = $tableRow;
        return $this;
    }

    public function getTableRow(){
        return $this->tableRow;
    }

}

?>