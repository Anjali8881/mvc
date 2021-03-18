<?php
namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class PaymentMethod extends \Model\Core\Table{

    
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    public function __construct(){
        $this->setTableName("paymentmethod");
        $this->setPrimaryKey("paymentMethodId");
    }
    
    public function getStatusOptions(){
        return [
            self::STATUS_ENABLE => "Enable",
            self::STATUS_DISABLE => "Disable"
        ];
    }
}
?>