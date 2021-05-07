<?php

namespace Controller\Admin;

class Payment extends \Controller\Core\Admin{ 

    public function __construct(){
        parent::__construct();
    }
   
    public function gridAction()
    {
        try {
            
            $grid = \Mage::getBlock("block\admin\payment\grid");
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
    public function formAction(){

        try {
            $form = \Mage::getBlock('block\admin\payment\edit');

            $id = (int)$this->getRequest()->getGet('id');
            $paymentPage = \Mage::getModel('Model\Payment'); 

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
            $payment = \Mage::getModel("Model\payment");
            if(!$this->getRequest()->isPost())
            {
                throw new \Exception("Invalid Post Request");
            }
            $paymentId =$this->getRequest()->getGet('id');
            if (!$paymentId) {
                date_default_timezone_set('Asia/Kolkata');
                $payment->createdDate = date("Y-m-d H:i:s");
                $this->getMessage()->setSuccess("Payment Done !!");
            }
            else{
                $payment =  $payment->load($paymentId);
                if (!$payment) {
                    throw new \Exception("Data Not Found");
                }
                $this->getMessage()->setSuccess("Payment Updated !!");
            }   
        
            $paymentData = $this->getRequest()->getPost('payment');
            if(!array_key_exists('status',$paymentData)){
                $paymentData['status']=0;
            }					
            else{
                $paymentData['status']=1;
            }
            $payment->setData($paymentData);  
            $payment->save();
            
        } 
        catch (\Exception $e) 
        {
            $this->getMessage()->setFailure($e->getMessage());
        }   
        $this->redirect('grid',null,null,true);       
    }
	public function changeStatusAction(){
		try {

			$id = $this->getRequest()->getGet('id');
			$st = $this->getRequest()->getGet('status');
			$model = \Mage::getModel('model\payment');
			$model->id =$id;
			$model->status = $st;
			$model->changeStatus();
            if($model->changeStatus()){
                $this->getMessage()->setSuccess("Payment Status Updated !!");
            }
            
			
		} catch (\Exception $e) {

            $this->getMessage()->setSuccess($e->getMessage());
		}
        $this->redirect('grid',null,null,true);
	}
	public function deleteAction(){
		try {
			
			$id = $this->getRequest()->getGet('id');
			$delModel = \Mage::getModel('model\payment');
			$delModel->methodId = $id;


            if($delModel->delete()){
                $this->getMessage()->setSuccess("Payment Deleted !!");
            }
            else{
                $this->getMessage()->setFailure("Unable To Delete Payment !!");
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
            
            $grid = \Mage::getBlock("block\admin\payment\grid")->setFilter($filterModel);
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

