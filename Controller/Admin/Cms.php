<?php
namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Cms extends \Controller\Core\Admin{

    protected $cmsDetails = [];
    protected $cmsModel = null;

    public function gridAction(){
        $cmsGrid = \Mage::getBlock('Block\Admin\Cms\Grid')->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'ajax working',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $cmsGrid
                ],
                [
                    'selector' => '#leftTabs',
                    'html' => ''
                ]
            ]
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);

    }

    public function setCms($cmsDetails){
        $this->cmsDetails = $cmsDetails;
        return $this;
    }

   public function getCms(){
        return $this->cmsDetails;
    }

    public function setCmsModel($cmsModel = null) {
		if (!$cmsModel) {
			$this->cmsModel = $cmsModel;	
		}
		$this->cmsModel = \Mage::getModel('Model\Cms');
		return $this;
	}

	public function getCmsModel()
	{
		if (!$this->cmsModel) {
			$this->setCmsModel();
		}
		return $this->cmsModel;
	}

    public function saveAction(){
        date_default_timezone_set('Asia/Kolkata');
        try{ 
            $cms = $this->getCmsModel();
			if ($id = (int) $this->getRequest()->getGet('id')) {
					$cms = $cms->load($id);

					if (!$cms) {
						$this->getMessage()->setFailure('Record Not Found');
					}
                    $this->getMessage()->setSuccess('Record Updated Successfully');
				}else{
                    $cms->createdDate = date('Y-m-d H:i:s');
                    $this->getMessage()->setSuccess('Record Inserted Successfully');
                } 
				$cmsData = $this->getRequest()->getPost('cms');
				$cms->setData($cmsData);
				$cms->save();
	
                $cmsGrid = \Mage::getBlock('Block\Admin\Cms\Grid')->toHtml();
                $response = [
                    'status' => 'success',
                    'message' => 'ajax working',
                    'element' => [
                        [
                            'selector' => '#contentHtml',
                            'html' => $cmsGrid
                        ],
                        [
                            'selector' => '#leftTabs',
                            'html' => ''
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
            $cmsEdit = \Mage::getBlock('Block\Admin\Cms\Edit');

            $cms = $this->getCmsModel();
            $id = $this->getRequest()->getGet('id');
            if($id){
                $cms = $cms->load($id);
                if(!$cms){
                    $this->getMessage()->setFailure('Record not found');
                }
            }
            $cmsEdit->setTableRow($cms);
            $cmsEdit = $cmsEdit->toHtml();
            $response = [
                    'status' => 'success',
                    'message' => 'Add/Edit Cms Details',
                    'element' => [
                        [
                            'selector' => '#contentHtml',
                            'html' => $cmsEdit
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
            $cmsId = (int) $this->getRequest()->getGet('id');
            if(!$cmsId){
                throw new \Exception("Id Required.");
            }
            $cmsData = $this->getCmsModel()->load($cmsId);
            if(!$cmsData){
                $this->getMessage()->setFailure('Unable to find data on this id.');
            }
            $this->getCmsModel()->delete($cmsId);
        
            $cmsGrid = \Mage::getBlock('Block\Admin\Cms\Grid')->toHtml();

            $response = [
                'status' => 'success',
                'message' => 'Data Succesfully Deleted',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' =>  $cmsGrid
                    ],
                    [
                        'selector' => '#leftTabs',
                        'html' => ''
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