<?php

namespace Controller\Admin;

class Shipment extends \Controller\Core\Admin{ 

    public function __construct(){
        parent::__construct();
    }
   
    public function gridAction()
    {

        try {
            
            $grid = \Mage::getBlock("block\admin\shipment\grid");
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
            $form = \Mage::getBlock('block\admin\shipment\edit');

            $id = (int)$this->getRequest()->getGet('id');
            $shipmentPage = \Mage::getModel('Model\Shipment'); 

            if ($id) {    
                $shipmentPage = $shipmentPage->load($id);
                if (!$shipmentPage) {
                    throw new \Exception("No shipmentPage Found!");
                }
            }
            
            $form->setTableRow($shipmentPage);
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
            $shipment = \Mage::getModel("Model\shipment");
            if(!$this->getRequest()->isPost())
            {
                throw new \Exception("Invalid Post Request");
            }
            $shipmentId =$this->getRequest()->getGet('id');
            if (!$shipmentId) {
                date_default_timezone_set('Asia/Kolkata');
                $shipment->createdDate = date("Y-m-d H:i:s");
                $this->getMessage()->setSuccess("Shipment Inserted !!");
            }
            else{
                $shipment =  $shipment->load($shipmentId);
                if (!$shipment) {
                    throw new \Exception("Data Not Found");
                }
                $this->getMessage()->setSuccess("Shipment Updated !!");
            }   
        
            $shipmentData = $this->getRequest()->getPost('shipment');
            if(!array_key_exists('status',$shipmentData)){
                $shipmentData['status']=0;
            }					
            else{
                $shipmentData['status']=1;
            }
            $shipment->setData($shipmentData);  
            $shipment->save();
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
			$model = \Mage::getModel('model\shipment');
			$model->id =$id;
			$model->status = $st;
			$model->changeStatus();
            if($model->changeStatus()){
                $this->getMessage()->setSuccess("Shipment Status Updated !! ");
            }
			
		} catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
		}
        $this->redirect("grid",null,null,true);
	}
	public function deleteAction(){
		try {
			
			$id = $this->getRequest()->getGet('id');
			$delModel = \Mage::getModel('model\shipment');
			$delModel->methodId = $id;


            if($delModel->delete()){
                $this->getMessage()->setSuccess("Shipment Deleted !! ");
            }
            else{
                $this->getMessage()->setSuccess("Unable To Delete Shipment !! ");
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
            
            $grid = \Mage::getBlock("block\admin\shipment\grid")->setFilter($filterModel);
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
