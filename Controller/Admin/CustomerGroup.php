<?php

namespace Controller\Admin;


  
class CustomerGroup extends \Controller\Core\Admin{ 

    public function __construct(){
        parent::__construct();
        
    }
   
    public function gridAction()
    {
        try {
            $grid = \Mage::getBlock("block\admin\customerGroup\grid");
            $contentHtml = $grid->toHtml();

            $response = [
                'status' => 'success',
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
            $this->getMessage()->setFailure($e->getMessage());
        }
    }
    public function formAction()
    {
        try {
            $form = \Mage::getBlock('block\admin\customerGroup\edit');

            $id = (int)$this->getRequest()->getGet('id');
            $customerGroup = \Mage::getModel('Model\customerGroup'); 

            if ($id) {    
                $customerGroup = $customerGroup->load($id);
                if (!$customerGroup) {
                    throw new \Exception("No customer Group Found!");
                }
            }
            
            $form->setTableRow($customerGroup);
            $contentHtml = $form->toHtml();

            $response = [
                'status' => 'success',
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
            $customerGroup = \Mage::getModel("Model\customerGroup");
            if(!$this->getRequest()->isPost())
            {
                throw new \Exception("Invalid Post Request");
            }
            $customerGroupId =$this->getRequest()->getGet('id');
            if (!$customerGroupId) {
                date_default_timezone_set('Asia/Kolkata');
                $customerGroup->createdDate = date("Y-m-d H:i:s");
                $this->getMessage()->setSuccess("Customer Group Inserted Successfully");
            }
            else{
                $customerGroup =  $customerGroup->load($customerGroupId);
                if (!$customerGroup) {
                    throw new \Exception("Data Not Found");
                }
                $this->getMessage()->setSuccess("Customer Group Updated Successfully");
            }   
        
            $customerGroupData = $this->getRequest()->getPost('customerGroup');
            if(!array_key_exists('status',$customerGroupData)){
                $customerGroupData['status']=0;
            }					
            else{
                $customerGroupData['status']=1;
            }
            $customerGroup->setData($customerGroupData);  
            $customerGroup->save();
            
        } 
        catch (\Exception $e) 
        {
            $this->getMessage()->setFailed($e->getMessage());
        }   
        $this->redirect('grid',null,null,true);       
    }
	public function changeStatusAction(){
		try {

			$id = $this->getRequest()->getGet('id');
			$st = $this->getRequest()->getGet('status');
			$customerGroup = \Mage::getModel('model\customerGroup');
			$customerGroup->id =$id;
			$customerGroup->status = $st;
			$customerGroup->changeStatus();
            if($customerGroup->changeStatus()){
                $this->getMessage()->setSuccess("Customer Group Status Updated Successfully");
            }
            
			
		} catch (\Exception $e) {
            $this->getMessage()->setFailed($e->getMessage());
		}
        $this->redirect('grid',null,null,true);
	}   

	public function deleteAction(){
		try {
			
			$id = $this->getRequest()->getGet('id');
			$delModel = \Mage::getModel('model\customerGroup');
			$delModel->group_id = $id;

           
            if($delModel->delete()){
                $this->getMessage()->setSuccess("Customer Group Deleted SuccessFully !!"); 
            }else{
                $this->getMessage()->setFailure("Unable to Delete Customer Group!!"); 
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
            
            $grid = \Mage::getBlock("block\admin\customerGroup\grid")->setFilter($filterModel);
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

