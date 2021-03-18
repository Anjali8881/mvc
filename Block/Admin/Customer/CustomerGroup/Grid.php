<?php
namespace Block\Admin\Customer\CustomerGroup;

\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template{

    protected $customerGroup = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/customer/customer_group/grid.php');
    }

    public function setCustomerGroups($customerGroup=null){
        if(!$customerGroup){
            $customerGroup = \Mage::getModel('Model\Customer\CustomerGroup');
            $customerGroup = $customerGroup->fetchAll();
        }
        $this->customerGroup = $customerGroup;
        return $this;
    }

    public function getCustomerGroups(){
        if(!$this->customerGroup){
            $this->setCustomerGroups();
        }
        return $this->customerGroup;
    }
}

?>