<?php
namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class PaymentMethod extends \Controller\Core\Admin{

    protected $paymentMethods = [];
    protected $paymentModel = null;

    public function gridAction(){
        $paymentGrid = \Mage::getBlock('Block\Admin\PaymentMethod\Grid')->toHtml();

        $response = [
            'status' => 'success',
            'message' => 'ajax working',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $paymentGrid
                ]
            ]
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }

    public function setPaymentMethod($paymentMethods){
        $this->paymentMethods = $paymentMethods;
        return $this;
    }

   public function getPaymentMethod(){
        return $this->paymentMethods;
    }

    public function setPaymentModel($paymentModel = null) {
		if (!$paymentModel) {
			$this->paymentModel = $paymentModel;	
		}
		$this->paymentModel = \Mage::getModel('Model\PaymentMethod');
		return $this;
	}

	public function getPaymentModel()
	{
		if (!$this->paymentModel) {
			$this->setPaymentModel();
		}
		return $this->paymentModel;
	}

    public function saveAction(){
        date_default_timezone_set('Asia/Kolkata');
        try{
            $paymentMethod = $this->getPaymentModel();
			if ($id = (int) $this->getRequest()->getGet('id')) {
					$paymentMethod = $paymentMethod->load($id);

					if (!$paymentMethod) {
						$this->getMessage()->setFailure('Record Not Found');		
					}
                    $this->getMessage()->setSuccess('Record Updated Successfully');
				} else {
					$paymentMethod->createdDate = date('Y-m-d H:i:s');
                    $this->getMessage()->setSuccess('Record Inserted Successfully');
				}
				
				$paymentData = $this->getRequest()->getPost('payment');

				$paymentMethod->setData($paymentData);
				$paymentMethod->save();
                $paymentMethodGrid  = \Mage::getBlock('Block\Admin\PaymentMethod\Grid')->toHtml();
                $response = [
                    'status' => 'success',
                    'message' => 'Save Data',
                    'element' => [
                        [
                            'selector' => '#contentHtml',
                            'html' => $paymentMethodGrid
                        ]
                    ]
                ];
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($response);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function editAction(){
        try{
            $paymentEdit = \Mage::getBlock('Block\Admin\PaymentMethod\Edit');

            $payment = $this->getPaymentModel();
            $id = $this->getRequest()->getGet('id');
            if($id){
                $payment = $payment->load($id);
                if(!$payment){
                    $this->getMessage()->setFailure('Record not found');
                }
            }
            $paymentEdit->setTableRow($payment);
            $paymentEdit = $paymentEdit->toHtml();
            $response = [
                    'status' => 'success',
                    'message' => 'Add/Edit Payment Details',
                    'element' => [
                        [
                            'selector' => '#contentHtml',
                            'html' => $paymentEdit
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
            
            $paymentMethodId = (int) $this->getRequest()->getGet('id');
            if(!$paymentMethodId){
                throw new \Exception("Id Required.");
            }
            $paymentMethodData = $this->getPaymentModel()->load($paymentMethodId);
            if(!$paymentMethodData){
                $this->getMessage()->setFailure('Unable to find data on this id.');
            }
            $this->getPaymentModel()->delete($paymentMethodId);
        
            $paymentGrid = \Mage::getBlock('Block\Admin\PaymentMethod\Grid')->toHtml();

            $response = [
                'status' => 'success',
                'message' => 'Data Succesfully Deleted',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $paymentGrid
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