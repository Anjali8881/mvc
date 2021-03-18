<?php
namespace Block\Admin\ShippingMethod\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

class Tabs extends \Block\Core\Edit\Tabs{


    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/shippingMethod/edit/tabs.php');
        $this->prepareTabs();
    }

    public function prepareTabs(){
       $this->addTab('shippingInformation',['label' => 'Shipping Information','block' => 'Block\Admin\ShippingMethod\Edit\Tabs\Form']);

       $this->setDefaultTab('shippingInformation');
        return $this;    
    }

}

?>