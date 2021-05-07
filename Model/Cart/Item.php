<?php

namespace Model\Cart;

use Mage;
use Exception;

class Item extends \Model\Core\Table
{
    protected $product = null;
    protected $cart = null;

    public function __construct()
    {
        $this->setTableName('cartitem');
        $this->setPrimaryKey('cartItemId');
    }

    public function getCart()
    {
        if (!$this->cartId) {
            return false;
        }
        $cart = Mage::getModel('Model\Cart')->load($this->cartId);
        $this->setCart($cart);
        return $this->cart;
    }

    public function setCart(\Model\Cart $cart)
    {
        $this->cart = $cart;
        return $this;
    }

    public function getProduct()
    {
        if (!$this->productId) {
            return false;
        }
        $product = Mage::getModel('Model\Product')->load($this->productId);
        $this->setProduct($product);
        return $this->product;
    }

    public function setProduct(\Model\Product $product)
    {
        $this->product = $product;
        return $this;
    }
}
