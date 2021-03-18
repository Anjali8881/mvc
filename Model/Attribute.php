<?php
namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class Attribute extends \Model\Core\Table{
    
    const BACKEND_VARCHAR = 'varchar';
    const BACKEND_INT = 'int';
    const BACKEND_TINYINT = 'tinyint';

    const INPUT_TEXT = 'text';
    const INPUT_RADIO = 'radio';
    const INPUT_CHECKBOX = 'checkbox';
    const INPUT_TEXTAREA = 'textarea';
    const INPUT_SELECT = 'select';
    const INPUT_MULTI = 'multi';

    const ENTITY_PRODUCT = 'product';
    const ENTITY_CATEGORY = 'category';

    public function __construct(){
        $this->setTableName("attribute");
        $this->setPrimaryKey("attributeId");
    }  
    
   public function getBackenedTypeOptions(){
        return [
            self::BACKEND_VARCHAR => 'varchar',
            self::BACKEND_INT => 'int',
            self::BACKEND_TINYINT => 'tinyint'
        ];
   }

   public function getInputTypeOptions(){
       return [
           self::INPUT_TEXT => 'text',
           self::INPUT_RADIO => 'radio',
           self::INPUT_CHECKBOX => 'checkbox',
           self::INPUT_TEXTAREA => 'textarea',
           self::INPUT_SELECT => 'select',
           self::INPUT_MULTI => 'multi'
       ];
   }

   public function getEntityTypes(){
        return [
            self::ENTITY_PRODUCT => 'product',
            self::ENTITY_CATEGORY => 'category'
        ];
   }

   public function getOptions()
    {
        if(!$this->attributeId){
            return false;
        }
        $attributeOption = \Mage::getModel('Model\Attribute\Option');
        $primaryKey = $this->getPrimaryKey();
        $query = "SELECT * FROM `{$attributeOption->getTableName()}` WHERE `$primaryKey` = '{$this->$primaryKey}' ORDER BY `sortOrder` ASC";
        $options = $attributeOption->fetchAll($query);
        return $options;

    }

    public function setEntityAttributes(){
        $tableName = $this->entityTypeId;
        $columnName = $this->name;
        $type = $this->backendType;

        if($type == "varchar"){
            $query = "ALTER TABLE `{$tableName}` ADD COLUMN `{$columnName}` {$type}(20)";
        }else{
            $query = "ALTER TABLE `{$tableName}` ADD COLUMN `{$columnName}` {$type}";
        }
        $attributeModel = \Mage::getModel('Model\Attribute');
        $result = $attributeModel->alterTable($query);
    }

    public function deleteEntity(){
        if($this->attributeId){
            $tableName = $this->entityTypeId;
            $query = "ALTER TABLE `{$tableName}` DROP COLUMN `{$this->name}`";
            $attributeModel = \Mage::getModel('Model\Attribute');
            $result = $attributeModel->alterTable($query);
        }
    }
}

?>