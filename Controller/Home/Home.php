<?php

namespace Controller\Home;

use Mage;
use Exception;
use Controller\Core\Admin as CoreAdmin;


Mage::loadClassByFileName('Controller\Core\Admin');

class Home extends CoreAdmin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $langing = Mage::getBlock("Block\Home\Landing");
        $this->getLayout()->setTemplate("./core/layout/home/index.php");
        $this->getLayout()->getChild("Content")->addChild($langing, 'Grid');
        $this->renderLayout();
    }

    public function gridAction()
    {

        $this->getLayout()->setTemplate("./core/layout/home/index.php");

        $shopBy = Mage::getBlock("Block\Home\ShopBy");
        $this->getLayout()->getChild("Content")->addChild($shopBy, 'Grid');

        $productGrid = Mage::getBlock("Block\Home\Products");
        $this->getLayout()->getChild("Content")->addChild($productGrid, 'ProductGrid');

        $this->renderLayout();
    }

    public function detailAction()
    {
        $this->getLayout()->setTemplate("./core/layout/home/index.php");

        $productDetails = Mage::getBlock("Block\Home\ProductDetails");
        $this->getLayout()->getChild("Content")->addChild($productDetails, 'Grid');
        $this->renderLayout();
    }

    public function checkoutAction()
    {
        try {
            $cart = $this->getCart();

            if (!$cart->getItems()) {
                throw new Exception("No Item In Cart", 1);
            }

            $this->getLayout()->setTemplate("./core/layout/home/index.php");

            $checkout = Mage::getBlock("Block\Home\Checkout");
            $this->getLayout()->getChild("Content")->addChild($checkout, 'Checkout');

            $checkout->setCart($cart);

            $this->renderLayout();
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirectToPrevious();
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

    public function placeOrderAction()
    {

        try {
            $customerId = Mage::getModel('\Model\Admin\Session')->customerId;

            $customer = Mage::getModel('\Model\Customer')->load($customerId);


            $cart = $this->getCart();

            $shipping = Mage::getModel('\Model\Shipment')->load($cart->shippingMethodId);
            $payment = Mage::getModel('\Model\Payment')->load($cart->paymentMethodId);

            $query = "SELECT * FROM cartaddress where cartId={$cart->cartId}";
            $cartAddress = Mage::getModel('\Model\Cart\Address')->fetchAll($query);

            $items = $this->getCart()->getItems();

            $order = Mage::getModel('\Model\OrderDetails');


             $order->setData($cart->getOriginalData());

            unset($order->sessionId);
            unset($order->cartId);

            $order->firstName = $customer->firstName;
            $order->lastName = $customer->lastName;
            $order->email = $customer->email;
            $order->contactNo = $customer->contactNo;
            $order->shippingName = $shipping->name;
            $order->shippingMethodCode = $shipping->code;
            $order->paymentName = $payment->name;
            $order->paymentMethodCode = $payment->code;
            $order->createdDate = date("Y-m-d H:i:s");

            if ($order = $order->save()) {
                $orderId = $order->getAdapter()->getConnect()->insert_id;

                foreach ($cartAddress->getData() as $address) {
                    $orderAddress = Mage::getModel('\Model\OrderDetails\Address');
                    $orderAddress->setData($address->getData());
                    unset($orderAddress->cartId);
                    unset($orderAddress->cartAddressId);
                    $orderAddress->orderId = $orderId;
                  
                    if (!$orderAddress->save()) {
                        throw new Exception("Order Failed", 1);
                    }
                    
                }
                foreach ($items->getData() as $value) {
                    $orderItem = Mage::getModel('\Model\OrderDetails\Item');

                    $orderItem->setData($value->getData());
                    unset($orderItem->cartItemId);
                    unset($orderItem->cartId);

                    $product = Mage::getModel('\Model\Product')->load($orderItem->productId);

                    $orderItem->orderId = $orderId;
                    $orderItem->productName = $product->productName;
                    $orderItem->createdDate = date("Y-m-d H:i:s");

                    if (!$orderItem->save()) {
                        throw new Exception("Order Failed", 1);
                    }
                }
                
                $query = "delete from `cart` where cartId = '{$cart->cartId}'";
            
                
                $cart->delete($query);

                $this->getMessage()->setSuccess("Order Placed !!");
            } else {
                throw new Exception("Order Failed", 1);
            }
        } catch (Exception $e) {
            if (!isset($orderId)) {
                $order->delete("DELETE FROM `orderdetails` WHERE `orderdetails`.`orderId` = {$orderId}");
            }
        }

        $this->redirect('index', 'home\home', null, true);
    }



    public function addItemToCartAction()
    {
        try {
            $id = (int)$this->getRequest()->getGet('id');
            $product = \Mage::getModel('Model\Product')->load($id);

            if (!$product) {
                throw new Exception("Product is not Available");
            }

            Mage::getModel('\Model\Admin\Session')->customerId = 21;

            $cart = $this->getCart();

            if ($this->getRequest()->isPost()) {
                $qty = $this->getRequest()->getPost('quantity');
            } else {
                $qty = 1;
            }

            if ($cart->addItem($product, $qty, true)) {

                $cart = $this->getCart();
                $cart->total = $this->getCart()->getTotal();

                $cart->save();

                $this->getMessage()->setSuccess('Item added to cart Successfully');
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $this->redirectToPrevious();

        //$this->redirect(null, null, null, true);
        //$this->redirect('grid', 'home\grid', null, true);
    }

    public function deleteAction()
    {
        try {
            $id = $this->getRequest()->getGet('id');


            if (!$id) {
                throw new \Exception('Id Invalid');
            }
            $item = \Mage::getModel('Model\Cart\Item');
            $item->load($id);


            if ($item) {
                $query = "delete from cartitem where `cartItemId`={$item->cartItemId}";
                if ($item->delete($query)) {
                    $cart = $this->getCart();
                    $cart->total = $this->getCart()->getTotal();

                    $cart->save();
                    $this->getMessage()->setSuccess('Record Deleted Successfully');
                } else {
                    $this->getMessage()->setFailure('Unable To Delete Record');
                }
            } else {
                $this->getMessage()->setFailure('Id Not found');
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $this->redirectToPrevious();

        //$this->redirect('grid', 'home\home', null, true);
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
                    $this->getMessage()->setSuccess('Shipping Address Added!.');
                }
            }
            $this->getMessage()->setSuccess('Address Added!.');

        } catch (\Exception $th) {
            $this->getMessage()->setFailure('Unable To Set Record');
        }
        
        $this->redirect('checkout','home\home');
    }
}
