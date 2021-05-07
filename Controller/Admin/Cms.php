<?php

namespace Controller\Admin;


class Cms extends \Controller\Core\Admin
{

    public function __construct()
    {
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
            
            $grid = \Mage::getBlock("block\admin\cms\grid");
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
            $e->getMessage();
        }

    }
    public function formAction()
    {
        try {
            $form = \Mage::getBlock('block\admin\cms\edit');

            $id = (int)$this->getRequest()->getGet('id');
            $cmsPage = \Mage::getModel('Model\Cms'); 

            if ($id) {    
                $cmsPage = $cmsPage->load($id);
                if (!$cmsPage) {
                    throw new \Exception("No cmsPage Found!");
                }
            }
            
            $form->setTableRow($cmsPage);
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
        try {

            $cms = \Mage::getModel("Model\Cms");
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Post Request", 1);
            }
            $id = $this->getRequest()->getGet('id');

            if (!$id) {
                $cms->createdDate = date("Y-m-d H:i:s");

                $this->getMessage()->setSuccess("CMS PAGE Inserted SuccessFully !!");

            } else {
                $cms =  $cms->load($id);
                if (!$cms) {
                    throw new \Exception("Data Not Found", 1);
                }
                $cms->id = $id;

                $this->getMessage()->setSuccess("CMS PAGE Updated SuccessFully !!");
            }

            $cmsData = $this->getRequest()->getPost('cms');


            if (!array_key_exists('status', $cmsData)) {
                $cmsData['status'] = 0;
            } else {
                $cmsData['status'] = 1;
            }

            $cms->setData($cmsData);
        
            $cms->save();
            

        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid', null, null, true);
    }
    public function changeStatusAction()
    {
        try {
            $id = $this->getRequest()->getGet('id');
            $st = $this->getRequest()->getGet('status');
            $model = \Mage::getModel('model\Cms');
            $model->id = $id;
            $model->status = $st;
            if ($model->changeStatus()) {
                $this->getMessage()->setSuccess("Status Changed Successfully");
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid', null, null, true);
    }
    public function deleteAction()
    {
        try {
            $id = $this->getRequest()->getGet('id');
            $model = \Mage::getModel('model\Cms');
            $model->id = $id;
            
            if ($model->delete()) {
                $this->getMessage()->setSuccess("Deleted Successfully");
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid', null, null, true);
    }

    public function filterAction()
    {
        try {
            $filters = $this->getRequest()->getPost('filter');

            $filterModel = \Mage::getModel('Model\Admin\Filter');
            $filterModel->setFilters($filters);
            
            $grid = \Mage::getBlock("block\admin\cms\grid")->setFilter($filterModel);
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
