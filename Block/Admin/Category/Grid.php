<?php
namespace Block\Admin\Category;

\Mage::loadFileByClassName('Block\Core\Template');

class Grid extends \Block\Core\Template{

    protected $categories = null;
    protected $categoriesOptions = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/category/grid.php');

    }

    public function setCategories($categories=null){
        if(!$categories){
            $categories = \Mage::getModel('Model\Category');
            $categories = $categories->fetchAll();
        }
        $this->categories =$categories;
        return $this;
    }

    public function getCategories(){
        if(!$this->categories){
            $this->setCategories();
        }
        return $this->categories;
    }

    public function getCategoriesOptions(){
        if($this->categoriesOptions){
            return $this->categoriesOptions;
        }
        $query = "SELECT `categoryId`,`name` from `category`";
        $categories = \Mage::getModel('Model\Category')->fetchAll($query);
        if($categories){
            foreach($categories->getData() as $category){
                $this->categoriesOptions[$category->categoryId] = $category->name;
            }
        }
        return $this->categoriesOptions;
    }

    public function getName($category){
        $categoriesData = $this->getCategoriesOptions();
        $pathId = explode('=',$category->categoryPath);
        foreach($pathId as &$id){
            if(array_key_exists($id,$categoriesData)){
                $id = $categoriesData[$id];
            }
        }
        return implode('=>',$pathId);
    }

}