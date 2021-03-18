<?php
namespace Block\Admin\Customer\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Template');
class Address extends \Block\Core\Template{

    protected $billingAddress = null;
    protected $shippingAddress = null;
    protected $tableRow = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/Customer/edit/tabs/address.php');
    }
    
    public function setBillingAddress($billingAddress = null){
        if($billingAddress){
            $this->billingAddress = $billingAddress;
            return $this;
        }
        $billingAddress = \Mage::getModel('Model\Customer\Address');
        if ($id = $this->getTableRow()->customerId) {
            $query = "SELECT * FROM `{$billingAddress->getTableName()}` WHERE `addressType` = '1' AND `customerId` = {$id}";
            $billingAddress = $billingAddress->fetchRow($query);
            if(!$billingAddress){
                $billingAddress = \Mage::getModel('Model\Customer\Address');
            }
        }
        $this->billingAddress = $billingAddress;
        return $this;
    }

    public function getBillingAddress(){
        if(!$this->billingAddress){
            $this->setBillingAddress();
        }
        return $this->billingAddress;
    }

    public function setShippingAddress($shippingAddress = null){
        if($shippingAddress){
            $this->shippingAddress = $shippingAddress;
            return $this;
        }
        $shippingAddress = \Mage::getModel('Model\Customer\Address');
        if ($id = $this->getTableRow()->customerId) {
            $query = "SELECT * FROM `{$shippingAddress->getTableName()}` WHERE `addressType` = '0' AND `customerId` = {$id}";
            $shippingAddress = $shippingAddress->fetchRow($query);
            if(!$shippingAddress){
                $shippingAddress = \Mage::getModel('Model\Customer\Address');
            }
        }
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    public function getShippingAddress(){
        if(!$this->shippingAddress){
            $this->setShippingAddress();
        }
        return $this->shippingAddress;
    }

    public function getFormUrl(){
        return $this->getUrl()->getUrl('save');
    }

    public function getTitle(){
        return 'Add/Edit Address Details';
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