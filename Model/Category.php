<?php
namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class Category extends \Model\Core\Table{

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    const FEATURED_YES = 1;
    const FEATURED_NO = 0;
    
    public function __construct(){
        $this->setTableName("category");
        $this->setPrimaryKey("categoryId");
    }

    public function getStatusOptions(){
        return [
            self::STATUS_ENABLE => "Enable",
            self::STATUS_DISABLE => "Disable"
        ];
    }
    
    public function getFeaturedOptions(){
        return [
            self::FEATURED_YES => "Yes",
            self::FEATURED_NO => "No"
        ];
    } 
    
    public function updatePathId(){
        if(!$this->parentCategoryId){
            $pathId = $this->categoryId;
        }else{
            $parent = \Mage::getModel('Model\Category')->load($this->parentCategoryId);
            if(!$parent){
                throw new \Exception('Unable to load parent.');
            }
            $pathId = $parent->categoryPath.'='.$this->categoryId;
        }
        $this->categoryPath = $pathId;
        return $this->save();
    }

    public function updateChildrenPathIds($categoryPathId,$parentId = null){
        $category = \Mage::getModel('Model\Category');
        $categoryPathId = $categoryPathId."=";
        $query = "SELECT * from `category` where categoryPath like '{$categoryPathId}%' ORDER BY categoryPath ASC";
        $categories = $category->getAdapter()->fetchAll($query);

        if($categories){
            foreach($categories as $key => $row){
                $row = \Mage::getModel('Model\Category')->load($row['categoryId']);
                if($parentId != null){
                    $row->parentCategoryId = $parentId;
                }
                $row->updatePathId();
            }
        }
    }
}

?>