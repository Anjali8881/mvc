<?php
namespace Controller\Admin;

\Mage::loadFileByClassName('Controller\Core\Admin');

class Product extends \Controller\Core\Admin{
    protected $products = [];
    protected $productModel = null;


    public function gridAction(){
        $gridHtml = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $response = [
            'status' => 'success',
            'message' => 'ajax working',
            'element' => [
                [
                    'selector' => '#contentHtml',
                    'html' => $gridHtml
                ]
            ]
        ];
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($response);
    }

    public function setProducts($products){
        $this->products = $products;
        return $this;
    }

   public function getProducts(){
        return $this->products;
    }

    public function setProductModel($productModel = null) {
		if (!$productModel) {
			$this->productModel = $productModel;	
		}
		$this->productModel = \Mage::getModel('Model\Product');
		return $this;
	}

	public function getProductModel()
	{
		if (!$this->productModel) {
			$this->setProductModel();
		}
		return $this->productModel;
	}

    public function saveAction(){
        //$request  = new Request();
        date_default_timezone_set('Asia/Kolkata');
        try{ 
            $product = $this->getProductModel();
			if ($id = (int) $this->getRequest()->getGet('id')) {
					$product = $product->load($id);

					if (!$product) {
						$this->getMessage()->setFailure('Record Not Found');		
					}
					$product->updatedDate = date('Y-m-d H:i:s');
                    $this->getMessage()->setSuccess('Record Updated Successfully');
				} else {
					$product->createdDate = date('Y-m-d H:i:s');
                    $this->getMessage()->setSuccess('Record Inserted Successfully');
				}
				
				$productData = $this->getRequest()->getPost('product');
				$product->setData($productData);

				$product->save();

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
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function editAction(){
        try{
            $productEdit = \Mage::getBlock('Block\Admin\Product\Edit');
            
            $product = $this->getProductModel();
            $id = $this->getRequest()->getGet('id');
            if($id){
                $product = $product->load($id);
                if(!$product){
                    $this->getMessage()->setFailure('Record not found');
                }
            }
            $productEdit->setTableRow($product);
            $productEdit = $productEdit->toHtml();
            $response = [
                    'status' => 'success',
                    'message' => 'Add/Edit Product Details',
                    'element' => [
                        [
                            'selector' => '#contentHtml',
                            'html' => $productEdit
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
            $productId = (int) $this->getRequest()->getGet('id');
            if(!$productId){
                throw new \Exception("Id Required.");
            }
            $productData = $this->getProductModel()->load($productId);
            if(!$productData){
                $this->getMessage()->setFailure('Unable to find data on this id.');
            }
            $this->getProductModel()->delete($productId);
        
            $productGrid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();

            $response = [
                'status' => 'success',
                'message' => 'Data Succesfully Deleted',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $productGrid
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