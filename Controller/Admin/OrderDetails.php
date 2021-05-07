<?php  

namespace Controller\Admin;
use Mage;
use Exception;

class OrderDetails extends \Controller\Core\Admin
{
    public function gridAction()
    {
        try {
            
            $grid = \Mage::getBlock("block\admin\OrderDetails\grid");
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

        // $gridBlock = Mage::getBlock('Block\Admin\OrderDetails\Grid');
        // $layout = $this->getLayout();
        // $layout->setTemplate('./core/layout/one_column.php');
        // $layout->getChild('Content')->addChild($gridBlock);
        // $this->renderLayout();
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

                $query = "delete from `cart` where `cartId` = {$cart->cartId}";

            
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

        $this->redirect('grid','admin\orderDetails', null, true);
    }
}

?>