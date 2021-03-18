<?php
namespace Controller\Admin\Product;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Media extends \Controller\Core\Admin{

    public function __construct()
    {
        parent::__construct();
    }

    public function uploadAction(){
        $name = $_FILES['file']['name'];
        $tmpName = $_FILES['file']['tmp_name'];
        $path = $_SERVER['DOCUMENT_ROOT'].'/questecom/images/';
        if(move_uploaded_file($tmpName,$path.$name)) {
            $mediaModel = \Mage::getModel('Model\Product\Media');
            $mediaModel->image = $name;
            $mediaModel->productId = $this->getRequest()->getGet('id');
            $mediaModel->save();
        }

        $productEdit = \Mage::getBlock('Block\Admin\Product\Edit');
            
            $product = \Mage::getModel('Model\Product');
            $id = $this->getRequest()->getGet('id');
            if($id){
                $product = $product->load($id);
                if(!$product){
                    $this->getMessage()->setFailure('Record not found');
                }
            }
            $productEdit->setTableRow($product);
            $productEdit = $productEdit->toHtml();

        $response = [
            'status' => 'success',
            'message' => 'Media Upload',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $productEdit
                ]
            ]
        ];

        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }

    public function deleteAction(){
        $removeData = $this->getRequest()->getPost('remove');
        $path = $_SERVER['DOCUMENT_ROOT'].'/questecom/images/';
        $mediaModel = \Mage::getModel('Model\Product\Media');
        foreach($removeData as $key => $value){
            $mediaModel->load($key);
            unlink($path.$mediaModel->image);
            $mediaModel->delete();
        }
        $productEdit = \Mage::getBlock('Block\Admin\Product\Edit');
            
        $product = \Mage::getModel('Model\Product');
        $id = $this->getRequest()->getGet('id');
        if($id){
            $product = $product->load($id);
            if(!$product){
                $this->getMessage()->setFailure('Record not found');
            }
        }
        $productEdit->setTableRow($product);
        $productEdit = $productEdit->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'Media Delete',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $productEdit
                ]
            ]
            ];
    
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
    }

    public function updateAction(){
        $mediaModel = \Mage::getModel('Model\Product\Media');
        $label = $this->getRequest()->getPost('label');
        $small = $this->getRequest()->getPost('small');
        $base = $this->getRequest()->getPost('base');
        $thumb = $this->getRequest()->getPost('thumb');
        $gallery = $this->getRequest()->getPost('gallery');

        foreach($label as $key => $value){
            $mediaModel->load($key);
            $mediaModel->label = $value;
            
            if($key == $small){
                $mediaModel->small = 1;
            }else{
                $mediaModel->small = 0;
            }

            if($key == $base){
                $mediaModel->base = 1;
            }else{
                $mediaModel->base = 0;
            }

            if($key == $thumb){
                $mediaModel->thumb = 1;
            }else{
                $mediaModel->thumb = 0;
            }

            if(array_key_exists($key,$gallery)){
                $mediaModel->gallery = 1;
            }else{
                $mediaModel->gallery = 0;
            }
            $mediaModel->save();
        }
        
        $productEdit = \Mage::getBlock('Block\Admin\Product\Edit');
            
        $product = \Mage::getModel('Model\Product');
        $id = $this->getRequest()->getGet('id');
        if($id){
            $product = $product->load($id);
            if(!$product){
                $this->getMessage()->setFailure('Record not found');
            }
        }
        $productEdit->setTableRow($product);
        $productEdit = $productEdit->toHtml();

        $response = [
            'status' => 'success',
            'message' => 'Media Delete',
            'element' => [
            [
            'selector' => '#contentHtml',
            'html' => $productEdit
            ]
            ]
            ];
    
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        
    }
   
    
}

?>