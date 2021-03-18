<?php
namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Category extends \Controller\Core\Admin{
    
    protected $categories = [];
    protected $categoryModel = null;

    public function gridAction(){
        $categoryGrid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'ajax working',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $categoryGrid
                ]
            ]
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);

    }

    public function setCategory($categories){
        $this->categories = $categories;
        return $this;
    }

   public function getCategory(){
        return $this->categories;
    }

    public function setCategoryModel($categoryModel = null) {
		if (!$categoryModel) {
			$this->categoryModel = $categoryModel;	
		}
		$this->categoryModel = \Mage::getModel('Model\Category');
		return $this;
	}

	public function getCategoryModel()
	{
		if (!$this->categoryModel) {
			$this->setCategoryModel();
		}
		return $this->categoryModel;
	}

    public function saveAction(){
        date_default_timezone_set('Asia/Kolkata');
        try{ 
            $category = $this->getCategoryModel();
			if ($id = (int) $this->getRequest()->getGet('id')) {
					$category = $category->load($id);

					if (!$category) {
						$this->getMessage()->setFailure('Record Not Found');
					}
                    $this->getMessage()->setSuccess('Record Updated Successfully');
				}else{
                    $category->createdDate = date('Y-m-d H:i:s');
                    $this->getMessage()->setSuccess('Record Inserted Successfully');
                }
                $categoryPathId = $category->categoryPath;

				$categoryData = $this->getRequest()->getPost('category');
				$category->setData($categoryData);
				$category->save();

                $category->updatePathId();

                $category->updateChildrenPathIds($categoryPathId);
	
                $categoryGrid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
                $response = [
                    'status' => 'success',
                    'message' => 'ajax working',
                    'element' => [
                        [
                            'selector' => '#contentHtml',
                            'html' => $categoryGrid
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
            $categoryEdit = \Mage::getBlock('Block\Admin\Category\Edit');

            $category = $this->getCategoryModel();
            $id = $this->getRequest()->getGet('id');
            if($id){
                $category = $category->load($id);
                if(!$category){
                    $this->getMessage()->setFailure('Record not found');
                }
            }
            $categoryEdit->setTableRow($category);
            $categoryEdit = $categoryEdit->toHtml();
            $response = [
                    'status' => 'success',
                    'message' => 'Add/Edit Cms Details',
                    'element' => [
                        [
                            'selector' => '#contentHtml',
                            'html' => $categoryEdit
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
            $categoryId = (int) $this->getRequest()->getGet('id');
            if(!$categoryId){
                throw new \Exception("Id Required.");
            }
            $category = $this->getCategoryModel()->load($categoryId);
            if(!$category){
                $this->getMessage()->setFailure('Unable to find data on this id.');
            }

            $pathId = $category->categoryPath;
            $parentId = $category->parentCategoryId;

            $category->updateChildrenPathIds($pathId,$parentId);

            if($this->getCategoryModel()->delete($categoryId)){
                $this->getMessage()->setSuccess('Record Deleted successfully');
            }else{
                $this->getMessage()->setFailure('Record Deleted Successfully');
            }
        
            $categoryGrid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();

            $response = [
                'status' => 'success',
                'message' => 'Data Succesfully Deleted',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $categoryGrid
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