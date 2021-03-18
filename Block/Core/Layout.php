<?php
namespace Block\Core;

\Mage::loadFileByClassName('Block\Core\Template');
\Mage::loadFileByClassName('Block\Core\Layout\Content');
\Mage::loadFileByClassName('Block\Core\Layout\Header');
\Mage::loadFileByClassName('Block\Core\Layout\Left');

class Layout extends \Block\Core\Template{
    
    public function __construct()
    {
        $this->setTemplate('./View/core/layout/three_column.php');
        $this->prepareChildren();
    }

    public function prepareChildren(){
        $this->addChild($this->createBlock('Block\Core\Layout\Content'),'content');
        $this->addChild($this->createBlock('Block\Core\Layout\Header'),'header');
        $this->addChild($this->createBlock('Block\Core\Layout\Left'),'left');
        $this->addChild($this->createBlock('Block\Core\Layout\Footer'),'footer');
    }

    public function getContent(){
        return $this->getChild('content');
        
    }

    public function getHeader(){
        return $this->getChild('header');
        
    }

    public function getLeft(){
        return $this->getChild('left');
        
    }

   


    

}

?>