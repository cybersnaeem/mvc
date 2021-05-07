<?php

namespace Controller\Admin;

class GroupPrice extends \Controller\Core\Admin
{
    public function __construct()
    {
        parent::__construct();
    }


    public function saveAction()
    {
        $productId = $this->getRequest()->getGet('id'); 
        $groupData = $this->getRequest()->getPost('groupPrice');
       
            if(array_key_exists('Exist',$groupData)){
                foreach ($groupData['Exist'] as $group_id => $groupPrice) {
                    $query ="UPDATE product_group_price SET groupPrice = {$groupPrice} WHERE groupId = {$group_id} AND productId = {$productId}";
                    $groupPriceModel = \Mage::getModel("Model\GroupPrice");
                    $groupPriceModel->update($query);
                    
                }
            }

            if(array_key_exists('New',$groupData)){
                foreach ($groupData['New'] as $group_id => $groupPrice) {
                    $groupPriceModel = \Mage::getModel("Model\GroupPrice");
                    $groupPriceModel->productId = $productId;
                    $groupPriceModel->groupId = $group_id;
                    $groupPriceModel->groupPrice = $groupPrice;
                    
                    $groupPriceModel->save();   
                }
            }


       $this->redirect('form','admin\product',null,false);
    }
}


?>