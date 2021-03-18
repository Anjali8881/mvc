<?php
namespace Block\Admin\Product;

\Mage::loadFileByClassName('Block\Core\Template');

class Grid extends \Block\Core\Template{
    protected $products = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/product/grid.php');

    }

    public function setProducts($products=null){
        if(!$products){
            $products = \Mage::getModel('Model\Product');
            $products = $products->fetchAll();
        }
        $this->products = $products;
        return $this;
    }

    public function getProducts(){
        if(!$this->products){
            $this->setProducts();
        }
        return $this->products;
    }
}

?>