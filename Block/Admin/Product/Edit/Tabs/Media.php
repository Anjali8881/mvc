<?php
namespace Block\Admin\Product\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Template');
class Media extends \Block\Core\Template{

 protected $media = null;
 protected $tableRow = null;

 public function __construct()
 {
     parent::__construct();
     $this-> setTemplate('./View/admin/product/edit/tabs/media.php');
 }

 public function setMedia($media = null){
    if($media){
        $this->media = $media;
        return $this;
    }
    $media = \Mage::getModel('Model\Product\Media');
    if($id = $this->getTableRow()->productId){
        $query = "SELECT * from `media` where `productId` = $id";
        $mediaData = $media->fetchAll($query);
        $this->media = $mediaData;
        return $this;
    }
    
}

public function getMedia(){
    if(!$this->media){
        $this->setMedia();
    }
    return $this->media;
}

public function setTableRow(\Model\Product $tableRow){
    $this->tableRow = $tableRow;
    return $this;
}

public function getTableRow(){
    return $this->tableRow;
}

}

?>