<?php

namespace Controller\Admin;

class Admin extends \Controller\Core\Admin{ 

    public function __construct(){
        parent::__construct();
        
    }

    public function gridAction()
    {
        try {
            
            $grid = \Mage::getBlock("block\admin\admin\grid");
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
            $form = \Mage::getBlock('block\admin\admin\edit');

            $id = (int)$this->getRequest()->getGet('id');
            $adminPage = \Mage::getModel('Model\Admin'); 

            if ($id) {    
                $adminPage = $adminPage->load($id);
                if (!$adminPage) {
                    throw new \Exception("No adminPage Found!");
                }
            }
            
            $form->setTableRow($adminPage);
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
            $admin = \Mage::getModel("Model\admin");
            
            if(!$this->getRequest()->isPost())
            {
                throw new \Exception("Invalid Post Request");
            }
            $adminId =$this->getRequest()->getGet('id');
            if ($adminId) { 
                $admin =  $admin->load($adminId);
                if (!$admin) {
                    throw new \Exception("Data Not Found");
                }
                $this->getMessage()->setSuccess("Admin Updated Successfully !!");
            }   
            else{
                $this->getMessage()->setSuccess("Admin Inserted Successfully !!");
            }
            $adminData = $this->getRequest()->getPost('admin');
            
            if(!array_key_exists('status',$adminData)){
                $adminData['status']=0;
            }					
            else{
                $adminData['status']=1;
            }
            $admin->setData($adminData);
            $admin->createdDate = date("Y-m-d H:i:s"); 
            $admin->save();
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
			$model = \Mage::getModel('model\admin');
			$model->id =$id;
			$model->status = $st;
			$model->changeStatus();
            if($model->changeStatus()){
                $this->getMessage()->setSuccess("Admin Status Change Successfully !!");
            }
		} catch (\Exception $e) {
		
			$this->getMessage()->setFailure($e->getMessage());
		}
        $this->redirect('grid',null,null,true);
    }
	public function deleteAction(){
		try {
		
			$id = $this->getRequest()->getGet('id');
			$delModel = \Mage::getModel('model\admin');
			$delModel->adminId = $id;
            if($delModel->delete()){
                $this->getMessage()->setSuccess("Admin Deleted Successfully !!");
            }
            else{
                $this->getMessage()->setFailure("Unable To Delete Admin !!");
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
            
            $grid = \Mage::getBlock("block\admin\admin\grid")->setFilter($filterModel);
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

