<?php
namespace Controller\Admin\Customer;

\Mage::loadFileByClassName('Controller\Core\Admin');

class CustomerGroup extends \Controller\Core\Admin{

    protected $customerGroups = [];
    protected $customerGroupModel = null;

    public function gridAction(){
        $customerGroupGrid = \Mage::getBlock('Block\Admin\Customer\CustomerGroup\Grid')->toHtml();

        $response = [
            'status' => 'success',
            'message' => 'ajax working',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $customerGroupGrid
            ]
                ]
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }

    public function setCustomerGroups($customerGroups){
        $this->customerGroups = $customerGroups;
        return $this;
    }

    public function getCustomerGroups(){
        return $this->customerGroups;
    }

    public function setCustomerGroupModel($customerGroupModel = null){
        if(!$customerGroupModel){
            $this->customerGroupModel = $customerGroupModel;
        }
        
        $this->customerGroupModel = \Mage::getModel('Model\Customer\CustomerGroup');
        return $this;
    }

    public function getCustomerGroupModel()
	{
		if (!$this->customerGroupModel) {
			$this->setCustomerGroupModel();
		}
		return $this->customerGroupModel;
	}

    public function saveAction(){
        date_default_timezone_set('Asia/Kolkata'); 
        try{
            $customerGroup = $this->getCustomerGroupModel();
            if($id = (int) $this->getRequest()->getGet('id')){
                $customerGroup = $customerGroup->load($id);

                if(!$customerGroup){
                    $this->getMessage()->setFailure('Record not found');
                }
                $this->getMessage()->setSuccess('Record Updated Successfully');
            }else{
                $customerGroup->createdDate = date('Y-m-d H:i:s');
                $this->getMessage()->setSuccess('Record Inserted Successfully');
            }
            $customerGroupData = $this->getRequest()->getPost('customerGroup');
        
            $customerGroup->setData($customerGroupData);

            $customerGroup->save();
            $customerGroupGrid = \Mage::getBlock('Block\Admin\Customer\CustomerGroup\Grid')->toHtml();

            $response = [
                'status' => 'success',
                'message' => 'Add/Edit Customer Group Details',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $customerGroupGrid
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
            $customerGroupEdit = \Mage::getBlock('Block\Admin\Customer\CustomerGroup\Edit');

            $customerGroup = $this->getCustomerGroupModel();
            $id = (int) $this->getRequest()->getGet('id');

            if($id){
                $customerGroup = $customerGroup->load($id);
                if(!$customerGroup){
                    $this->getMessage()->setFailure('Record not found');
                }
            }
            $customerGroupEdit->setTableRow($customerGroup);
            $customerGroupEdit = $customerGroupEdit->toHtml();
            $response = [
                    'status' => 'success',
                    'message' => 'Add/Edit Customer Group Details',
                    'element' => [
                        [
                            'selector' => '#contentHtml',
                            'html' => $customerGroupEdit
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
            $customerGroupId = (int) $this->getRequest()->getGet('id');
            if(!$customerGroupId){
                throw new \Exception("Id Required.");
            }
            $customerGroupData = $this->getCustomerGroupModel()->load($customerGroupId);
            if(!$customerGroupData){
                $this->getMessage()->setFailure('Unable to find data on this id.');
            }
            $this->getCustomerGroupModel()->delete($customerGroupId);
        
            $customerGroupGrid = \Mage::getBlock('Block\Admin\Customer\CustomerGroup\Grid')->toHtml();

            $response = [
                'status' => 'success',
                'message' => 'Data Succesfully Deleted',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $customerGroupGrid
                    ],
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