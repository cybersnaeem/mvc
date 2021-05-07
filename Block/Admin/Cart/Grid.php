<?php

namespace Block\Admin\Cart;

use Exception;

class Grid extends \Block\Core\Grid
{
    protected $cart = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/cart/grid.php');
    }

    public function getCart()
    {
        if (!$this->cart) {
            throw new Exception("Cart Not Set", 1);
            
        }
        return $this->cart;
    }

    public function setCart(\Model\Cart $cart)
    {
        
        $this->cart = $cart;
        return $this;
    }

    public function getId($id)
    {
        $this->getRequest()->getGet('id');
        echo $id;
    }

    public function getCustomers()
    {
        return \Mage::getModel('Model\Customer')->fetchAll();
    }

     public function getItems()
    {
        if (!$this->items) {
            return \Mage::getModel('Model\Cart')->getItems();
        }
    } 
    public function getTotal()
    {
        $cartId = $this->getCart()->getItems()->getData()[0]->cartId;
        $cartItem = \Mage::getModel('\Model\Cart\Item');
        $query = "select cast(sum((`price`-(`price`*`discount`/100))*`quantity`) as DECIMAL(10,2)) as `total` from `cartitem` where `cartId`='{$cartId}'";
        return $cartItem->getAdapter()->fetchRow($query)['total'];
    }
}
