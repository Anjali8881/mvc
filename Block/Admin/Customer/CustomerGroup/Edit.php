<?php 
namespace Block\Admin\Customer\CustomerGroup;

\Mage::getModel('Block\Core\Edit');

class Edit extends \BLock\Core\Edit{

    protected $customerGroup = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTabClass(\Mage::getBlock('Block\Admin\Customer\CustomerGroup\Edit\Tabs'));
    }

    public function getTitle(){
        return 'Add/Edit Customer Group Details';
    }
}

?>