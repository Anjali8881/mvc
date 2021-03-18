<?php
namespace Block\Admin\Customer;

\Mage::loadFileByClassName('Block\Core\Template');

class Grid extends \Block\Core\Template{

    protected $customers = null;
    protected $groups = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/customer/grid.php');
    }

    public function setCustomers($customers=null){
        if(!$customers){
            $customers = \Mage::getModel('Model\Customer');
            $customers = $customers->fetchAll();
        }
        $this->customers = $customers;
        return $this;
    }

    public function getCustomers(){
        if(!$this->customers){
            $this->setCustomers();
        }
        return $this->customers;
    }

    public function getCustomerAddress($customer){
        $id  = $customer->customerId;
        $customerAddress = '';
        $query = "SELECT `zipcode` from `customeraddress` where `addressType` = '1' and `customerId` = '{$id}' ";
        $customers = \Mage::getModel('Model\Customer')->fetchAll($query);
        if($customers){
            foreach($customers->getData() as $key => $value){
                $customerAddress = $value->zipcode;
            }
        }
        return $customerAddress;
    }

    public function getCustomerGroups($customer = null)
	{
		$customerModel = \Mage::getModel('Model\Customer');
		$name = '';
		if (!$this->groups) {
			$query = "SELECT groupId,name FROM `customergroup`";
			$this->groups = $customerModel->getAdapter()->fetchPairs($query);
			
		}
		$customerGroupId[] = $customer->groupId;
		foreach ($customerGroupId as $groupId) {
			if (array_key_exists($groupId, $this->groups)) {
					$name = $this->groups[$groupId];
				}	
		}	
		return $name;
	}

}