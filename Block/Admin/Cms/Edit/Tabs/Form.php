<?php
namespace Block\Admin\Cms\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Template');
class Form extends \Block\Core\Template{

    // protected $cmsDetail = null;
    protected $tableRow = null;
    
    public function __construct()
    {
        parent::__construct();
        $this-> setTemplate('./View/admin/cms/edit/tabs/form.php');
    }

    // public function setCms($cmsDetail = null){
    //     if($cmsDetail){
    //         $this->cmsDetail = $cmsDetail;
    //         return $this;
    //     }
    //     $cmsDetail = \Mage::getModel('Model\Cms');
    //     if($id = $this->getRequest()->getGet('id')){
    //         $cmsDetail =$cmsDetail->load($id);
    //     }
    //     $this->cmsDetail = $cmsDetail;
    //     return $this;
    // }

    // public function getCms(){
    //     if(!$this->cmsDetail){
    //         $this->setCms();
    //     }
    //     return $this->cmsDetail;
    // }

    public function setTableRow(\Model\Cms $tableRow){
        $this->tableRow = $tableRow;
        return $this;
    }

    public function getTableRow(){
        return $this->tableRow;
    }

}

?>