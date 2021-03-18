<?php
namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Admin extends \Controller\Core\Admin{
    protected $admin = [];
    protected $adminModel = null;

    public function gridAction(){
        $adminGrid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'ajax working',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $adminGrid
                ]
            ]
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }

    public function setAdmin($admin){
        $this->admin = $admin;
        return $this;
    }

   public function getAdmin(){
        return $this->admin;
    }

    public function setAdminModel($adminModel = null) {
		if (!$adminModel) {
			$this->adminModel = $adminModel;	
		}
		$this->adminModel = \Mage::getModel('Model\Admin');
		return $this;
	}

	public function getAdminModel()
	{
		if (!$this->adminModel) {
			$this->setAdminModel();
		}
		return $this->adminModel;
	}

    public function saveAction(){
        date_default_timezone_set('Asia/Kolkata'); 
        try{
            $admin = $this->getAdminModel();
            if($id = (int) $this->getRequest()->getGet('id')){
                $admin = $admin->load($id);

                if(!$admin){
                    $this->getMessage()->setFailure('Record not found');
                }
            }else{
                $admin->createdDate = date('Y-m-d H:i:s');
                $this->getMessage()->setSuccess('Record Inserted Successfully');
            }
            $adminData = $this->getRequest()->getPost('admin');
            $admin->setData($adminData);
            
            $admin->save();
            $adminGrid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();

            $response = [
                'status' => 'success',
                'message' => 'Add/Edit Admin Details',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $adminGrid
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
            $adminEdit = \Mage::getBlock('Block\Admin\Admin\Edit');
            $admin = $this->getAdminModel();
            $id = $this->getRequest()->getGet('id');
            if($id){
                $admin = $admin->load($id);
                if(!$admin){
                    $this->getMessage()->setFailure('Record not found');
                }
            }
            $adminEdit->setTableRow($admin);
            $adminEdit = $adminEdit->toHtml();
            $response = [
                    'status' => 'success',
                    'message' => 'Add/Edit Admin Details',
                    'element' => [
                        [
                            'selector' => '#contentHtml',
                            'html' => $adminEdit
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
                $adminId = (int) $this->getRequest()->getGet('id');
                if(!$adminId){
                    throw new \Exception("Id Required.");
                }
                $adminData = $this->getAdminModel()->load($adminId);
                if(!$adminData){
                    $this->getMessage()->setFailure('Unable to find data on this id.');
                }
                $this->getAdminModel()->delete($adminId);
            
                $adminGrid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();

                $response = [
                    'status' => 'success',
                    'message' => 'Data Succesfully Deleted',
                    'element' => [
                        [
                            'selector' => '#contentHtml',
                            'html' => $adminGrid
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