<?php

namespace Controller\Admin;

class ConfigurationGroup extends \Controller\Core\Admin
{ 

    public function __construct(){
        parent::__construct();
        
    }

    public function gridAction()
    {
        try {
            
            $grid = \Mage::getBlock("block\admin\ConfigurationGroup\grid");
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
            $form = \Mage::getBlock('block\admin\ConfigurationGroup\edit');

            $id = (int)$this->getRequest()->getGet('id');
            $cgroupPage = \Mage::getModel('Model\ConfigurationGroup'); 

            if ($id) {    
                $cgroupPage = $cgroupPage->load($id);
                if (!$cgroupPage) {
                    throw new \Exception("No configGroupPage Found!");
                }
            }
            
            $form->setTableRow($cgroupPage);
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
            $configGroup = \Mage::getModel("Model\ConfigurationGroup");
            
            if(!$this->getRequest()->isPost())
            {
                throw new \Exception("Invalid Post Request");
            }

            $configGroupId =$this->getRequest()->getGet('id');
            if ($configGroupId) { 
                $configGroup = $configGroup->load($configGroupId);
                if (!$configGroup) {
                    throw new \Exception("Data Not Found");
                }
                $this->getMessage()->setSuccess("Configuration Group Updated Successfully !!");
            }   
            else{
                $this->getMessage()->setSuccess("Configuration Group Inserted Successfully !!");
            }
            $configGroupData = $this->getRequest()->getPost('configurationGroup');
            
            $configGroup->setData($configGroupData);
            $configGroup->createdDate = date("Y-m-d H:i:s"); 
            $configGroup->save();
        } 
        catch (\Exception $e) 
        {
            $this->getMessage()->setFailure($e->getMessage());
        }          
        $this->redirect('grid',null,null,true);
    }

	public function deleteAction(){
		try {
			
			$id = $this->getRequest()->getGet('id');
			$delModel = \Mage::getModel('model\configurationGroup');
			$delModel->groupId = $id;

            if($delModel->delete()){
                $this->getMessage()->setSuccess("Configuration Group Deleted Successfully !!");
            }
            else{
                $this->getMessage()->setFailure("Unable To Delete Configuration Group !!");
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
            
            $grid = \Mage::getBlock("block\admin\ConfigurationGroup\grid")->setFilter($filterModel);
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

