<?php
namespace Block\Admin\Cms;

\Mage::loadFileByClassName('Block\Core\Template');

class Grid extends \Block\Core\Template{

    protected $cmsDetails = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/cms/grid.php');

    }

    public function setCms($cmsDetails=null){
        if(!$cmsDetails){
            $cmsDetails = \Mage::getModel('Model\Cms');
            $cmsDetails = $cmsDetails->fetchAll();
        }
        $this->cmsDetails = $cmsDetails;
        return $this;
    }

    public function getCms(){
        if(!$this->cmsDetails){
            $this->setCms();
        }
        return $this->cmsDetails;
    }

}