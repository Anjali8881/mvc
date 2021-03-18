<?php
namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Customer extends \Controller\Core\Admin{
    protected $customers = [];
    protected $customerModel = null;


    public function gridAction(){
        $customerGrid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'ajax working',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $customerGrid
                ]
            ]
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }

    public function setCustomers($customers){
        $this->customers = $customers;
        return $this;
    }

   public function getCustomers(){
        return $this->customers;
    }

    public function setCustomerModel($customerModel = null) {
		if (!$customerModel) {
			$this->customerModel = $customerModel;	
		}
		$this->customerModel = \Mage::getModel('Model\Customer');
		return $this;
	}

	public function getCustomerModel()
	{
		if (!$this->customerModel) {
			$this->setCustomerModel();
		}
		return $this->customerModel;
	}

    public function saveAction(){
        date_default_timezone_set('Asia/Kolkata');
        try{
            if(!$this->getRequest()->getGet('tab')){
                $customer = $this->getCustomerModel();
                if($id = (int) $this->getRequest()->getGet('id')){
                    $customer = $customer->load($id);

                    if(!$customer){
                        $this->getMessage()->setFailure('Record not found');
                    }
                    $customer->updatedDate = date('Y-m-d H:i:s');
                    $this->getMessage()->setSuccess('Record Updated Successfully');
                }else{
                    $customer->createdDate = date('Y-m-d H:i:s');
                    $this->getMessage()->setSuccess('Record Inserted Successfully');
                }
                $customerData = $this->getRequest()->getPost('customer');
                $customer->setData($customerData);
                
                $customer->save();
                if(!$id = (int) $this->getRequest()->getGet('id')){
                    $shipping = \Mage::getModel('Model\Customer\Address');
                    $billing = \Mage::getModel('Model\Customer\Address');
                    $shipping->addressType = 0;
                    $shipping->customerId = $customer->customerId;
                    $billing->addressType = 1;
                    $billing->customerId = $customer->customerId;
                    $shipping->save();
                    $billing->save();
                }
            }else{
                $customer = $this->getCustomerModel();
                if($id = (int) $this->getRequest()->getGet('id')){
                    $customer = $customer->load($id);

                    if(!$customer){
                        $this->getMessage()->setFailure('Record not found');
                    }
                }
                $shippingAddress = \Mage::getModel('Model\Customer\Address');
                $billingAddress = \Mage::getModel('Model\Customer\Address');

                $query = "SELECT * FROM `customeraddress` where `addressType`  = '0' AND `customerId` = '{$id}'";
                $shippingAddress = $shippingAddress->fetchRow($query);
                if(!$shippingAddress){
                    $shippingAddress = \Mage::getModel('Model\Customer\Address');
                }
                $query = "SELECT * FROM `customeraddress` where `addressType`  = '1' AND `customerId` = '{$id}'";
                $billingAddress = $billingAddress->fetchRow($query);
                if(!$billingAddress){
                    $billingAddress = \Mage::getModel('Model\Customer\Address');
                }

                $shippingData = $this->getRequest()->getPost('shipping');
                $shippingAddress->setData($shippingData);
                $shippingAddress->customerId = $this->getRequest()->getGet('id');
                $shippingAddress->addressType = 0;
                $shippingAddress->save();

                $billingData = $this->getRequest()->getPost('billing');
                $billingAddress->setData($billingData);
                $billingAddress->customerId = $this->getRequest()->getGet('id');
                $billingAddress->addressType = 1;
                $billingAddress->save();
            } 
            $customerGrid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
            $response = [
                'status' => 'success',
                'message' => 'Add/Edit Customer Details',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $customerGrid
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
            $customerEdit = \Mage::getBlock('Block\Admin\Customer\Edit');

            $customer = $this->getCustomerModel();
            $id = $this->getRequest()->getGet('id');
            if($id){
                $customer = $customer->load($id);
                if(!$customer){
                    $this->getMessage()->setFailure('Record not found');
                }
            }
            $customerEdit->setTableRow($customer);
            $customerEdit = $customerEdit->toHtml();
            $response = [
                    'status' => 'success',
                    'message' => 'Add/Edit Attribute Details',
                    'element' => [
                        [
                            'selector' => '#contentHtml',
                            'html' => $customerEdit
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
            $customerId = (int) $this->getRequest()->getGet('id');
            if(!$customerId){
                throw new \Exception("Id Required.");
            }
            $customerData = $this->getCustomerModel()->load($customerId);
            if(!$customerData){
                $this->getMessage()->setFailure('Unable to find data on this id.');
            }
            $this->getCustomerModel()->delete($customerId);
        
            $customerGrid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();

            $response = [
                'status' => 'success',
                'message' => 'Data Succesfully Deleted',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $customerGrid
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