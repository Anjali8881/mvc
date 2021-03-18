<?php
namespace Block\Admin\Customer\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

class Tabs extends \Block\Core\Edit\Tabs{

    protected $tabs = [];
    protected $defaultTab = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/customer/edit/tabs.php');
        $this->prepareTabs();
    }

    public function prepareTabs(){
       $this->addTab('customer',['label' => 'Customer Information','block' => 'Block\Admin\Customer\Edit\Tabs\Form']);
       $this->addTab('Address',['label' => 'Customer Address','block' => 'Block\Admin\Customer\Edit\Tabs\Address']);
    
       $this->setDefaultTab('customer');
        return $this;    
    }

}

?>