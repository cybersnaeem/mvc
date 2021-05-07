<?php

namespace Controller\Admin;


  
class Product extends \Controller\Core\Admin{ 

    public function __construct(){
        parent::__construct();
        
    }

    public function indexAction()
    {
        $layout = $this->getLayout();
        $this->renderLayout();
    }

    public function gridAction()
    {
        try {
            
            $grid = \Mage::getBlock("block\admin\product\grid");
            $contentHtml = $grid->toHtml();

            $response = [
                'status' => 'success',
                'message' => 'hello',
                'element' => [
                    [
                    'selector' => '#contentHtml',
                    'html' => $contentHtml
                    ],
                ]
            ];

            header('Content-Type:application/json');
            echo json_encode($response);
            
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
    public function formAction()
    {
        try {
            $form = \Mage::getBlock('block\admin\product\edit');

            $id = (int)$this->getRequest()->getGet('id');
            $paymentPage = \Mage::getModel('Model\Product'); 

            if ($id) {    
                $paymentPage = $paymentPage->load($id);
                if (!$paymentPage) {
                    throw new \Exception("No paymentPage Found!");
                }
            }
            
            $form->setTableRow($paymentPage);
            $contentHtml = $form->toHtml();

            $response = [
                'status' => 'success',
                'message' => 'hello',
                'element' => [
                    [
                        'selector' => '#contentHtml',
                        'html' => $contentHtml
                    ]
                ]
            ];

            header('Content-Type:application/json');
            echo json_encode($response);
        } catch (\Exception $e) {
            $e->getMessage();
        }    

    }
   
    public function saveAction()
    {
        try 
        {
            $product = \Mage::getModel("Model\product");
            

            if(!$this->getRequest()->isPost())
            {
                throw new \Exception("Invalid Post Request", 1);
            }
            $productId =$this->getRequest()->getGet('id');
            if (!$productId) {
                date_default_timezone_set('Asia/Kolkata');
                $product->createdDate = date("Y-m-d H:i:s");
                

                $this->getMessage()->setSuccess("Product Inserted SuccessFully !!");

            }
            else{
                $product =  $product->load($productId);
                if (!$product) {
                    throw new \Exception("Data Not Found", 1);
                }
                date_default_timezone_set('Asia/Kolkata');
                $product->updatedDate = date("y-m-d h:i:s");
                $product->productId = $productId;
                
                $this->getMessage()->setSuccess("Product Updated SuccessFully !!"); 
            }   
            
            $productData = $this->getRequest()->getPost('product');
            
            foreach ($productData as $key => $value) {
                if (is_array($value)) {
                    $value = implode(',', $value);
                    $productData[$key] = $value;
                }
            }
            
            
            if(!array_key_exists('status',$productData)){
                $productData['status']=0;
            }					
            else{
                $productData['status']=1;
            }
            

            $product->setData($productData); 

            $product->save();
            
        } 
        catch (\Exception $e) 
        {
            $this->getMessage()->setFailure($e->getMessage());
            
        }  
    $this->redirect('grid',null,null,true);    
    }

    public function saveCategoryAction()
    {
        try {
            $product = \Mage::getModel("Model\Product");
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Post Request", 1);
            }
            $productId = $this->getRequest()->getGet('id');
            $categoryId = $this->getRequest()->getPost('product')['categoryId'];

            $query = "update product set categoryId={$categoryId} where productId={$productId}";
           
            $product->getAdapter()->update($query);

        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('form', null, [], false);
    }


	public function changeStatusAction(){
		try {

			$id = $this->getRequest()->getGet('id');
			$st = $this->getRequest()->getGet('status');
			$model = \Mage::getModel('model\product');
			$model->id =$id;
			$model->status = $st;
            if($model->changeStatus()){
                $this->getMessage()->setSuccess("Status Changed Successfully"); 
            }
            
		} catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage()); 
		}
        $this->redirect('grid',null,null,true);
	}
	public function deleteAction(){
		try {
		
			$id = $this->getRequest()->getGet('id');
			$delModel = \Mage::getModel('model\product');
			$delModel->productId = $id;


            if($delModel->delete()){
                $this->getMessage()->setSuccess("Product Deleted SuccessFully !!"); 
            }else{
                $this->getMessage()->setFailure("Error While Deleting Data!!"); 
            }
            
		} catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage()); 
		}
        $this->redirect('grid',null,null,true);
	}
    
    public function filterAction()
    {
        try {
            $filters = $this->getRequest()->getPost('filter');

            $filterModel = \Mage::getModel('Model\Admin\Filter');
            $filterModel->setFilters($filters);
            
            $grid = \Mage::getBlock("block\admin\product\grid")->setFilter($filterModel);
            $contentHtml = $grid->toHtml();

            $response = [
                'status' => 'success',
                'message' => 'hello',
                'element' => [
                    [
                    'selector' => '#contentHtml',
                    'html' => $contentHtml
                    ],
                ]
            ];

            header('Content-Type:application/json');
            echo json_encode($response);
            
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

}
?>

