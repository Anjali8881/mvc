<?php
namespace Block\Admin\Attribute\Edit;

\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

class Tabs extends \Block\Core\Edit\Tabs{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/attribute/edit/tabs.php');
        $this->prepareTabs();
    }

    public function prepareTabs(){
       $this->addTab('attribute',['label' => 'Attribute Information','block' => 'Block\Admin\Attribute\Edit\Tabs\Form']);
       $this->addTab('option',['label' => 'Attribute Option','block' => 'Block\Admin\Attribute\Edit\Tabs\Option']);
    
       $this->setDefaultTab('attribute');
        return $this;    
    }

}

?>