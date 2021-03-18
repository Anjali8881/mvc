<?php
namespace Block\Admin\PaymentMethod\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Template');

class Form extends \Block\Core\Template{

   //protected $paymentMethod = null;
   protected $tableRow = null;
    
    public function __construct()
    {
        parent::__construct();
        $this-> setTemplate('./View/admin/paymentMethod/edit/tabs/form.php');
    }

    // public function setPaymentMethod($paymentMethod = null){
    //     if($paymentMethod){
    //         $this->paymentMethod = $paymentMethod;
    //         return $this;
    //     }
    //     $paymentMethod = \Mage::getModel('Model\PaymentMethod');
    //     if($id = $this->getRequest()->getGet('id')){
    //         $paymentMethod = $paymentMethod->load($id);
    //     }
    //     $this->paymentMethod = $paymentMethod;
    //     return $this;
    // }

    // public function getPaymentMethod(){
    //     if(!$this->paymentMethod){
    //         $this->setPaymentMethod();
    //     }
    //     return $this->paymentMethod;
    // }

    
    public function setTableRow(\Model\PaymentMethod $tableRow){
        $this->tableRow = $tableRow;
        return $this;
    }

    public function getTableRow(){
        return $this->tableRow;
    }

}

?>