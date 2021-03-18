<?php
namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Attribute extends \Controller\Core\Admin{
    
    protected $attributes = [];
    protected $attributeModel = null;

    public function gridAction(){
        $attributeGrid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'ajax working',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $attributeGrid
                ]
            ]
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }

    public function setAttibutes($attributes){
        $this->attributes = $attributes;
        return $this;
    }

   public function getAttributes(){
        return $this->attributes;
    }

    public function setAttributeModel($attributeModel = null) {
		if (!$attributeModel) {
			$this->attributeModel = $attributeModel;	
		}
		$this->attributeModel = \Mage::getModel('Model\Attribute');
		return $this;
	}

	public function getAttributeModel()
	{
		if (!$this->attributeModel) {
			$this->setAttributeModel();
		}
		return $this->attributeModel;
	}

    public function saveAction(){
        try{ 
            $attribute = $this->getAttributeModel();
			if ($id = (int) $this->getRequest()->getGet('id')) {
					$attribute = $attribute->load($id);

					if (!$attribute) {
						$this->getMessage()->setFailure('Record Not Found');
					}
                    $this->getMessage()->setSuccess('Record Updated Successfully');
				}else{
                    $this->getMessage()->setSuccess('Record Inserted Successfully');
                } 
				$attributeData = $this->getRequest()->getPost('attribute');
				$attribute->setData($attributeData);
				$attribute->save();
                $attribute->setEntityAttributes();
                
                $attributeGrid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
                $response = [
                    'status' => 'success',
                    'message' => 'ajax working',
                    'element' => [
                        [
                            'selector' => '#contentHtml',
                            'html' => $attributeGrid
                        ]
                    ]
                ];
                header("Content-type: application/json; charset=utf-8");
                echo json_encode($response);
            }catch(\Exception $e){
                $this->getMessage()->setFailure($e->getMessage());
            }
    }

    public function editAction(){
        try{
            $attributeEdit = \Mage::getBlock('Block\Admin\Attribute\Edit');

            $attribute = $this->getAttributeModel();
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
                    'message' => 'Add/Edit Attribute Details',
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
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function deleteAction(){
        try{
            $attributeId = (int) $this->getRequest()->getGet('id');
            if(!$attributeId){
                throw new \Exception("Id Required.");
            }
            $attribute = $this->getAttributeModel();
            $attributeData = $attribute->load($attributeId);
            if(!$attributeData){
                $this->getMessage()->setFailure('Unable to find data on this id.');
            }
           if($attribute->delete($attributeId)){
               $this->getMessage()->setFailure('Record Deleted Successfully');
           }
            $attribute->deleteEntity();
        
            $attributeGrid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();

            $response = [
                'status' => 'success',
                'message' => 'Data Succesfully Deleted',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' =>  $attributeGrid
                    ]
                ]
            ];
            header("Content-type: application/json; charset=utf-8");
            echo json_encode($response);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }



}

?>