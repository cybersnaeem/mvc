<?php

namespace Controller\Admin;

use Mage;

use Exception;

class Cart extends \Controller\Core\Admin
{



    public function addItemToCartAction()
    {
        try {
            $id = (int)$this->getRequest()->getGet('id');
            $product = Mage::getModel('Model\Product')->load($id);
            

            if (!$product) {
                throw new Exception("Product is not Available");
            }

            Mage::getModel('\Model\Admin\Session')->customerId = 21;

            $cart = $this->getCart();
            
            
            if ($cart->addItem($product, 1, true)) {
                $this->getMessage()->setSuccess('Item added to cart Successfully');
            } else {
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $this->redirect('grid', 'admin\cart', null, false);
    }


    public function gridAction()
    {

        try {
            
            $grid = \Mage::getBlock("block\admin\cart\grid");
            $cart = $this->getCart();
            $grid->setCart($cart);

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

    protected function getCart($customerId = NULL)
    {
        $session = \Mage::getModel('Model\Admin\Session');

        if ($customerId) {
            $session->customerId = $customerId;
        }

        $sessionId = \Mage::getModel('Model\Admin\Session')->getId();
        $cart = \Mage::getModel('Model\Cart');
        $query = "SELECT * FROM `cart` WHERE `customerId` = '{$session->customerId}'";
        $cart = $cart->fetchRow($query);
        
        if ($cart) {
            return $cart;
        }

        $cart = \Mage::getModel('Model\Cart');
        $cart->customerId = $session->customerId;
        $cart->createdDate = date('Y-m-d H:i:s');
        $cart->sessionId = $sessionId;
        $cart->save();
        return $cart;
    }

    public function selectCustomerAction()
    {
        $customerId = $this->getRequest()->getPost('customer');
    
        $this->getCart($customerId); 
        
        $this->redirect('grid', 'admin\cart', null, true);
    }

    public function updateAction()
    {
        try {

            $cart = $this->getCart();

            $prices = $this->getRequest()->getPost('price');

            foreach ($prices as $cartItemId => $price) {
                $cartItem = \Mage::getModel('Model\Cart\Item')->load($cartItemId);
                $cartItem->price = $price;
                $cartItem->save();
                $this->getMessage()->setSuccess('Item Update to cart Successfully');
                
            }
            
            $quantities = $this->getRequest()->getPost('quantity');

            

            foreach ($quantities as $cartItemId => $quantity) {
                $cartItem = \Mage::getModel('Model\Cart\Item')->load($cartItemId);
                $cartItem->quantity = $quantity;
                $cartItem->save();
                $this->getMessage()->setSuccess('Item Update to cart Successfully');
            }
        } catch (\Exception $th) {
            echo $th->getMessage();
        }

        $this->redirect('grid');
    }

    public function checkoutAction()
    {

        try {
            
            $grid = \Mage::getBlock("block\admin\cart\Checkout");
            $cart = $this->getCart();
            $grid->setCart($cart);

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
    public function DeleteAction()
    {
        try {

            $id = $this->getRequest()->getGet('id');

            if (!$id) {
                throw new \Exception('Id Invalid');
            }

            $item = \Mage::getModel('Model\Cart\Item');

            $itemRow = $item->load($id)->cartItemId;
            
            $query = "DELETE from `cartitem` WHERE `cartItemId` = {$itemRow}";
            
            if ($item->delete($query)) {
                $this->getMessage()->setSuccess('Record Deleted Successfully');
            } else {
                $this->getMessage()->setFailure('Unable To Delete Record');
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid');
    }

    public function saveAction()
    {
        try {

            $shipping = $this->getRequest()->getPost('shipping');
            $billing = $this->getRequest()->getPost('billing');
            $cartId = $this->getCart()->getItems()->getData()[0]->cartId;
            $cart = $this->getCart();
            $cartData = $this->getRequest()->getPost('cart');
            


            if ($billing) {
                $cartBillingAddress = Mage::getModel('\Model\Cart\Address');
                $query = "SELECT * FROM `cartaddress` where `cartId`='{$cartId}' and `addressType`='Billing'";

                if (!$cartBillingAddress->fetchRow($query)) {
                    $cartBillingAddress->addressType = "Billing";
                    $cartBillingAddress->sameAsBilling = 1;
                    $cartBillingAddress->cartId = $cartId;
                    $cartBillingAddress->setData($billing)->save();
                    $this->getMessage()->setSuccess('Billing Address Added.');
                } else {
                    $cartBillingAddress->setData($billing)->save();
                }

                if ($this->getRequest()->getPost('billingSaveAddressBook')) {
                    $customer = $this->getCart()->getCustomer();
                    $customerAddress = Mage::getModel('\Model\CustomerAddress');

                    if ($customer->customerId) {
                        $query = "SELECT * FROM `customer_address` where `customerId`={$customer->customerId} and `addressType`='Billing'";
                        if ($customerAddress->fetchRow($query)) {
                            $customerAddress->setData($billing)->save();
                            $this->getMessage()->setSuccess('Address Book Updated.');
                        } else {
                            $customerAddress->customerId = $customer->customerId;
                            $customerAddress->AddressType = "Billing";
                            $customerAddress->setData($billing)->save();
                            $this->getMessage()->setSuccess('Address Book Added.');

                        }
                    }
                }
            }

            if ($shipping) {

                if ($shipping['sameAsBilling']) {
                    $shipping = $billing;
                    $shipping['sameAsBilling'] = 0;
                }

                $cartBillingAddress = Mage::getModel('\Model\Cart\Address');
                $query = "SELECT * FROM `cartaddress` where `cartId`='{$cartId}' and `addressType`='Shipping'";

                if (!$cartBillingAddress->fetchRow($query)) {
                    $cartBillingAddress->addressType = "Shipping";
                    $cartBillingAddress->cartId = $cartId;
                    $cartBillingAddress->setData($shipping)->save();
                    $this->getMessage()->setSuccess('Shipping Address Added!.');

                } else {
                    $cartBillingAddress->setData($shipping)->save();
                   
                }

                if ($this->getRequest()->getPost('shippingSaveAddressBook')) {
                    $customer = $this->getCart()->getCustomer();
                    $customerAddress = Mage::getModel('\Model\CustomerAddress');

                    if ($customer->customerId) {
                        $query = "SELECT * FROM `customer_address` where `customerId`={$customer->customerId} and `addressType`='Shipping'";
                        if ($customerAddress->fetchRow($query)) {
                            $customerAddress->setData($shipping);
                            unset($customerAddress->sameAsBilling);
                            $customerAddress->save();
                            $this->getMessage()->setSuccess('Record Inserted In AddressBook !.');
                        } else {
                            $customerAddress->customerId = $customer->customerId;
                            $customerAddress->AddressType = "Shipping";
                            $customerAddress->setData($shipping)->save();
                            $this->getMessage()->setSuccess('Record Updated In AddressBook !.');
                        }
                    }
                }
            }

            if($cartData){
                $shippingId = \Mage::getModel('Model\shipment')->load($cartData['shippingMethodId']);
                
                
                $cart = $this->getCart();
                
                $cart->cartId = $cart->cartId;
                $cart->shippingMethodAmount = $shippingId->amount;
                $cart->paymentMethodId = $cartData['paymentMethodId'];
                $cart->shippingMethodId = $cartData['shippingMethodId'];

                if($cart->save()){
                    $this->getMessage()->setSuccess('Success..');
                }
            }
            
        } catch (\Exception $th) {
            $this->getMessage()->setFailure('Unable To Set Record');
        }

        $this->redirect('checkout','admin\OrderDetails',null,true);
    }

}


?>