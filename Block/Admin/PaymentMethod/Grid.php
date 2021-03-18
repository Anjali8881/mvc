<?php
namespace Block\Admin\PaymentMethod;

\Mage::loadFileByClassName('Block\Core\Template');

class Grid extends \Block\Core\Template{

    protected $paymentMethods = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/paymentMethod/grid.php');

    }

    public function setPaymentMethods($paymentMethods=null){
        if(!$paymentMethods){
            $paymentMethods = \Mage::getModel('Model\PaymentMethod');
            $paymentMethods = $paymentMethods->fetchAll();
        }
        $this->paymentMethods = $paymentMethods;
        return $this;
    }

    public function getPaymentMethods(){
        if(!$this->paymentMethods){
            $this->setPaymentMethods();
        }
        return $this->paymentMethods;
    }
}

?>