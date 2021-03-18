<?php

namespace Block\Core;

\Mage::loadFileByClassName('Block\Core\Template');

class Edit extends \Block\Core\Template{

    protected $tab = null;
    protected $tabClass = null;
    protected $tableRow = null;

    
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/core/edit.php');
    }

    public function getTabContent(){
        $tabBlock = $this->getTab();
        $tabs = $tabBlock->getTabs();

        $tab = $this->getRequest()->getGet('tab',$tabBlock->getDefaultTab());

        if(!array_key_exists($tab,$tabs)){
            return null;
        }
        $blockName = $tabs[$tab]['block'];

        return \Mage::getBlock($blockName)->setTableRow($this->getTableRow())->toHtml();
        
    }

    public function setTableRow(\Model\Core\Table $tableRow){
        $this->tableRow = $tableRow;
        return $this;
    }

    public function getTableRow(){
        return $this->tableRow;
    }

    public function getTabHtml(){
        return $this->getTab()->toHtml();
    }

    public function setTab($tab = null){
        if(!$tab){
            $tab = $this->getTabClass();
        }
        $this->tab = $tab;
        return $this;
    }

    public function getTab(){
        if(!$this->tab){
            $this->setTab();
        }
        return $this->tab;
    }

    public function setTabClass($tabClass){
        $this->tabClass = $tabClass;
    }

    public function getTabClass(){
        return $this->tabClass;
    }
}


?>