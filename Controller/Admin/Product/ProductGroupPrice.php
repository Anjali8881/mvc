<?php
namespace Controller\Admin\Product;

\Mage::loadFileByClassName('Controller\Core\Admin');

class ProductGroupPrice extends \Controller\Core\Admin{

    public function saveAction(){
        
        $groupData = $this->getRequest()->getPost('groupPrice');
       
        $productId = $this->getRequest()->getGet('id');
        if(array_key_exists('new',$groupData)){
            foreach($groupData['new'] as $groupId => $price){
                $groupPrice = \Mage::getModel('Model\Product\Group\Price');
                $groupPrice->customerGroupId = $groupId;
                $groupPrice->productId = $productId;
                $groupPrice->price = $price;
                $groupPrice->save();
            }
        }
        if(array_key_exists('exist',$groupData)){
            foreach($groupData['exist'] as $groupId => $price){
                $query = "SELECT * FROM productgroupprice
                WHERE `productId` = '{$productId}'
                AND `customerGroupId` = '{$groupId}'";
                $groupPrice = \Mage::getModel('Model\Product\Group\Price');
                $groupPrice->fetchRow($query);
                $groupPrice->price =  $price;
                $groupPrice->save();
            }
        }
       
        $productGrid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'ajax working',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $productGrid
                ]
            ]
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }
}

?>