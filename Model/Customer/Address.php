<?php
namespace Model\Customer;

\Mage::loadFileByClassName('Model\Core\Table');
class Address extends \Model\Core\Table{

    const ADDRESS_BILLING = 1;
    const ADDRESS_SHIPPING = 0;

    public function __construct(){
        $this->setTableName("customeraddress");
        $this->setPrimaryKey("addressId");
    }

    public function getAddressOptions(){
        return [
            self::ADDRESS_BILLING => "Billing",
            self::ADDRESS_SHIPPING => "Shipping"
        ];
    }    
}
?>