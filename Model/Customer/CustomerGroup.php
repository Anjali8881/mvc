<?php
namespace Model\Customer;

\Mage::loadFileByClassName('Model\Core\Table');

class CustomerGroup extends \Model\Core\Table{

    const DEFAULT_YES = 1;
    const DEFAULT_NO = 0;

    public function __construct(){
        $this->setTableName("customergroup");
        $this->setPrimaryKey("groupId");
    }

    public function getDefaultOptions(){
        return [
            self::DEFAULT_YES => "Yes",
            self::DEFAULT_NO => "No"
        ];
    }    
}

?>