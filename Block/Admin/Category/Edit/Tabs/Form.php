<?php
namespace Block\Admin\Category\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Template');

class Form extends \Block\Core\Template{

    //protected $category = null;
    protected $tableRow = null;
    protected $categoryOptions = [];
    
    public function __construct()
    {
        parent::__construct();
        $this-> setTemplate('./View/admin/category/edit/tabs/form.php');
    }

    // public function setCategory($category = null){
    //     if($category){
    //         $this->category = $category;
    //         return $this;
    //     }
    //     $category = \Mage::getModel('Model\Category');
    //     if($id = $this->getRequest()->getGet('id')){
    //         $category = $category->load($id);
    //     }
        
    //     $this->category = $category;
    //     return $this;
    // }

    // public function getCategory(){
    //     if(!$this->category){
    //         $this->setCategory();
    //     }
    //     return $this->category;
    // }

    public function setTableRow(\Model\Category $tableRow){
        $this->tableRow = $tableRow;
        return $this;
    }

    public function getTableRow(){
        return $this->tableRow;
    }

    public function getCategoryOptions(){
        if(!$this->categoryOptions){
            $query = "SELECT `categoryId`,`name` FROM `{$this->getTableRow()->getTableName()}`;";
            $options = $this->getTableRow()->getAdapter()->fetchPairs($query);

            $query = "SELECT `categoryId`,`categoryPath` FROM `{$this->getTableRow()->getTableName()}`;";
            $this->categoryOptions = $this->getTableRow()->getAdapter()->fetchPairs($query);

            if($this->categoryOptions){
                foreach($this->categoryOptions as $categoryId => &$categoryPath){

                    $pathIds = explode('=',$categoryPath);

                    foreach($pathIds as $key => &$id){
                        if(array_key_exists($id,$options)){
                            $id = $options[$id];
                        }
                    }
                    $categoryPath = implode('=>',$pathIds);                   
                }
            }
            $this->categoryOptions = [""=>"Root Category"] + $this->categoryOptions;
        }
        return $this->categoryOptions;
    }

}

?>