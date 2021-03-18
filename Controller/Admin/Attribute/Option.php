<?php
namespace Controller\Admin\Attribute;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Option extends \Controller\Core\Admin{

    public function __construct()
    {
        parent::__construct();
    }

    public function saveAction(){
        try{
            $optionData = $this->getRequest()->getPost();
            if(array_key_exists('exist',$optionData)){
                foreach ($optionData['exist'] as $optionId => $name) {
                    $optionModel = \Mage::getModel('Model\Attribute\Option');
                    $optionModel->load($optionId);
                    $optionModel->name = $name['name'];
                    $optionModel->sortOrder = $name['sortOrder'];
                    $optionModel->save();
                }
            }
            if(array_key_exists('new', $optionData)){
                foreach ($optionData['new']['name'] as $key => $value) {
                
                    $optionModel = \Mage::getModel('Model\Attribute\Option');
                    $optionModel->attributeId = $this->getRequest()->getGet('id');
                    $optionModel->name = $value;
                    $optionModel->sortOrder = $optionData['new']['sortOrder'][$key];
                    $optionModel->save();
                }
            }
                
            $attribute = \Mage::getModel('Model\Attribute');

            if($id = $this->getRequest()->getGet('id')){
                $attribute = $attribute->load($id);
                    if (!$attribute) {
                        throw new \Exception("No Data Found");
                    }
                }
            
                $attributeEdit = \Mage::getBlock('Block\Admin\Attribute\Edit');

                $attribute = \Mage::getModel('Model\Attribute');
                $id = $this->getRequest()->getGet('id');
                if($id){
                    $attribute = $attribute->load($id);
                    if(!$attribute){
                        $this->getMessage()->setFailure('Record not found');
                    }
                }
                $attributeEdit->setTableRow($attribute);
                $attributeEdit = $attributeEdit->toHtml();
                
                $response = [
                    'status' => 'success',
                    'message' => 'Option Details',
                    'element' => [
                        [
                        'selector' => '#contentHtml',
                        'html' => $attributeEdit
                        ]
                    ]
                ];
                
                header("Content-type: application/json; charset=utf-8");
                echo json_encode($response);
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }
}

?>