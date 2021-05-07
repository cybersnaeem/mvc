<?php

namespace Controller\Admin;

use \Exception;


class Attribute extends \Controller\Core\Admin
{

    public function __construct()
    {
        parent::__construct();
    }

    public function gridAction()
    {
        try {
            
            $grid = \Mage::getBlock("block\admin\Attribute\Grid");
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
            $form = \Mage::getBlock('block\admin\Attribute\edit');

            $id = (int)$this->getRequest()->getGet('id');
            $attributePage = \Mage::getModel('Model\Attribute'); 

            if ($id) {    
                $attributePage = $attributePage->load($id);
                if (!$attributePage) {
                    throw new \Exception("No Attribute Found!");
                }
            }
            
            $form->setTableRow($attributePage);
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
            $attribute = \Mage::getModel("Model\Attribute");
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Post Request", 1);
            }
            $attributeId = $this->getRequest()->getGet('id');
            $attributeData = $this->getRequest()->getPost('attribute');

            if (!$attributeId) {
                $attribute->setData($attributeData);

                if ($attribute->save()) {

                    $modelname = 'Model\\' . $attributeData['entityTypeId'];

                    $model = \Mage::getModel($modelname);
                    $query = "ALTER TABLE `{$attributeData['entityTypeId']}` ADD `{$attributeData['name']}` {$attributeData['backendType']} NOT NULL;";

                    if (!$model->alterTable($query)) {
                        throw new \Exception("Error!!", 1);
                    }

                    $this->getMessage()->setSuccess("Attribute Inserted SuccessFully !!");
                } else {
                    throw new \Exception("Insertion Error");
                }
            } else {
                $attribute =  $attribute->load($attributeId);
                if (!$attribute) {
                    throw new \Exception("Data Not Found", 1);
                }
                $attribute->setData($attributeData);


                $attribute->attributeId = $attributeId;

                if (!$attribute->save()) {
                    $this->getMessage()->setSuccess("Attribute Updated SuccessFully !!");
                } else {
                    throw new \Exception("Update Error");
                }
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
            $delModel = \Mage::getModel('Model\Attribute');
            $attributeData = $delModel->load($id);
            $modelname = 'Model\\' . $attributeData->entityTypeId;

            $model = \Mage::getModel($modelname);

            $query = "ALTER TABLE `{$attributeData->entityTypeId}` DROP `{$attributeData->name}`;";
            

        
            if ($model->alterTable($query)) {

                $qry = "delete from `attribute` where `attributeId` = {$id}";

                if ($delModel->delete($qry)) {
                    $this->getMessage()->setSuccess("Attribute Deleted SuccessFully!!");
                }
            } else {
                $this->getMessage()->setFailure("Error While Deleting Data!!");
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        
        }
        $this->redirect('grid', null, null, true);
    }

    // public function optionAction()
    // {
    //     $attribute = \Mage::getModel('Model\Attribute');
    //     $id = $this->getRequest()->getGet('id');
    // }

    // public function testAction()
    // {
    //     $query = "SELECT * FROM `attribute` WHERE `entityTypeId` = 'product'";
    //     $attributes = \Mage::getModel('Model\Attribute')->fetchAll($query);
    //     foreach ($attributes->getData() as $key => $attribute) {
    //         //$option = \Mage::getModel($attribute->backendModel)->setAttribute($attribute)->getOptions();
    //         print_r($attribute->getOption());
    //     }
    // }

    public function filterAction()
    {
        try {
            $filters = $this->getRequest()->getPost('filter');

            $filterModel = \Mage::getModel('Model\Admin\Filter');
            $filterModel->setFilters($filters);
            
            $grid = \Mage::getBlock("block\admin\Attribute\grid")->setFilter($filterModel);
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
