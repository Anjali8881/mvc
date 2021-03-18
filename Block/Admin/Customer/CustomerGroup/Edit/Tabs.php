<?php
namespace Block\Admin\Customer\CustomerGroup\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

class Tabs extends \Block\Core\Edit\Tabs{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/customer/customer_group/edit/tabs.php');
        $this->prepareTabs();
    }

    public function prepareTabs(){
       $this->addTab('customerGroup',['label' => 'Customer Group Information','block' => 'Block\Admin\Customer\CustomerGroup\Edit\Tabs\Form']);
    
       $this->setDefaultTab('customerGroup');
        return $this;    
    }

}

?>