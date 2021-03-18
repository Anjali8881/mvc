<?php
namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class ShippingMethod extends \Controller\Core\Admin{

    protected $shippingMethods = [];
    protected $shippingMethodModel = null;

    public function gridAction(){
        $shippingGrid = \Mage::getBlock('Block\Admin\ShippingMethod\Grid')->toHtml();

        $response = [
            'status' => 'success',
            'message' => 'ajax working',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $shippingGrid
                ]
            ]
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }

    public function setShippingMethod($shippingMethods){
        $this->shippingMethods = $shippingMethods;
        return $this;
    }

   public function getShippingMethod(){
        return $this->shippingMethods;
    }

    public function setShippingModel($shippingMethodModel = null) {
		if (!$shippingMethodModel) {
			$this->shippingMethodModel = $shippingMethodModel;	
		}
		$this->shippingMethodModel = \Mage::getModel('Model\ShippingMethod');
		return $this;
	}

	public function getShippingModel()
	{
		if (!$this->shippingMethodModel) {
			$this->setShippingModel();
		}
		return $this->shippingMethodModel;
	}

    public function saveAction(){
        date_default_timezone_set('Asia/Kolkata');
        try{
            
            $shippingMethod = $this->getShippingModel();
			if ($id = (int) $this->getRequest()->getGet('id')) {
					$shippingMethod = $shippingMethod->load($id);

					if (!$shippingMethod) {
						$this->getMessage()->setFailure('Record Not Found');		
					}
                    $this->getMessage()->setSuccess('Record Updated Successfully');
				} else {
					$shippingMethod->createdDate = date('Y-m-d H:i:s');
                    $this->getMessage()->setSuccess('Record Inserted Successfully');
				}
				
				$shippingData = $this->getRequest()->getPost('shipping');
				$shippingMethod->setData($shippingData);

				$shippingMethod->save();
                $shippingGrid = \Mage::getBlock('Block\Admin\ShippingMethod\Grid')->toHtml();
                $response = [
                    'status' => 'success',
                    'message' => 'Save/ Edit Shipping Information',
                    'element' => [
                        [
                            'selector' => '#contentHtml',
                            'html' => $shippingGrid
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
            $shippingEdit = \Mage::getBlock('Block\Admin\ShippingMethod\Edit');

            $shipping = $this->getShippingModel();
            $id = $this->getRequest()->getGet('id');
            if($id){
                $shipping = $shipping->load($id);
                if(!$shipping){
                    $this->getMessage()->setFailure('Record not found');
                }
            }
            $shippingEdit->setTableRow($shipping);
            $shippingEdit = $shippingEdit->toHtml();
            $response = [
                    'status' => 'success',
                    'message' => 'Add/Edit Shipping Details',
                    'element' => [
                        [
                            'selector' => '#contentHtml',
                            'html' => $shippingEdit
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
            $shippingMethodId = (int) $this->getRequest()->getGet('id');
            if(!$shippingMethodId){
                throw new \Exception("Id Required.");
            }
            $shippingMethodData = $this->getShippingModel()->load($shippingMethodId);
            if(!$shippingMethodData){
                $this->getMessage()->setFailure('Unable to find data on this id.');
            }
            $this->getShippingModel()->delete($shippingMethodId);
        
            $shippingGrid = \Mage::getBlock('Block\Admin\ShippingMethod\Grid')->toHtml();

            $response = [
                'status' => 'success',
                'message' => 'Data Succesfully Deleted',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $shippingGrid
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