<?php
namespace Block\Admin\Cms\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

class Tabs extends \Block\Core\Edit\Tabs{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/cms/edit/tabs.php');
        $this->prepareTabs();
    }

    public function prepareTabs(){
       $this->addTab('cms',['label' => 'Cms Information','block' => 'Block\Admin\Cms\Edit\Tabs\Form']);
       $this->setDefaultTab('cms');
        return $this;    
    }
}

?>