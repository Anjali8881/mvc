<?php
namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class Cms extends \Model\Core\Table{

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;
    
    public function __construct(){
        $this->setTableName("cmspage");
        $this->setPrimaryKey("pageId");
    }
    
    public function getStatusOptions(){
        return [
            self::STATUS_ENABLE => "Enable",
            self::STATUS_DISABLE => "Disable"
        ];
    }
}

?>