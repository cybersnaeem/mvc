<?php

namespace Block\Home;

use Mage;

Mage::loadClassByFileName("Block\Core\Template");

class Checkout extends \Block\Core\Template
{
    protected $cart = null;

    public function __construct()
    {
        $this->setTemplate("./home/checkout.php");
    }

    public function getCart()
    {
        if (!$this->cart) {
            throw new \Exception("Cart Is Not Set");
        }
        return $this->cart;
    }

    public function setCart(\Model\Cart $cart)
    {
        $this->cart = $cart;
        return $this;
    }

    public function getId()
    {
        return $this->getRequest()->getGet('id');;
    }

    public function getBillingAddress()
    {

        $cartBillingAddress = $this->getCart()->getBillingAddress();

        if ($cartBillingAddress) {
            return $cartBillingAddress;
        }

        $billingAddress = $this->getCart()->getCustomer()->getBillingAddress();


        if ($billingAddress) {
            $cartAddress = \Mage::getModel('Model\Cart\Address');
            $cartAddress->address_id = $billingAddress->address_id;
            $cartAddress->addressType = $billingAddress->addressType;
            $cartAddress->address = $billingAddress->address;
            $cartAddress->city = $billingAddress->city;
            $cartAddress->state = $billingAddress->state;
            $cartAddress->country = $billingAddress->country;
            $cartAddress->zipCode = $billingAddress->zipCode;
            $cartAddress->cartId = $this->getCart()->getItems()->getData()[0]->cartId; //---
            $cartAddress->save();
            return $cartAddress;
        }

        return Null;
    }

    public function getShippingAddress()
    {
        $cartShippingAddress = $this->getCart()->getShippingAddress();

        if ($cartShippingAddress) {
            return $cartShippingAddress;
        }

        $shippingAddress = $this->getCart()->getCustomer()->getShippingAddress();

        if ($shippingAddress) {
            $cartAddress = \Mage::getModel('Model\Cart\Address');
            $cartAddress->address_id = $shippingAddress->address_id;
            $cartAddress->addressType = $shippingAddress->addressType;
            $cartAddress->address = $shippingAddress->address;
            $cartAddress->city = $shippingAddress->city;
            $cartAddress->state = $shippingAddress->state;
            $cartAddress->country = $shippingAddress->country;
            $cartAddress->zipCode = $shippingAddress->zipCode;
            $cartAddress->cartId = $this->getCart()->getItems()->getData()[0]->cartId; //---
            $cartAddress->save();
            return $cartAddress;
        }

        return Null;
    }

    public function getCountries()
    {
        return ["INDIA", "USA", "JAPAN", "SINGAPORE", "CANADA"];
    }

    public function getCities()
    {
        return ["VALSAD", "VAPI", "SURAT", "AHMEDABAD", "VADODARA"];
    }

    public function getStates()
    {
        return ["GUJARAT", "MAHARASHTRA", "GOA", "RAJASTHAN", "MADHYAPRADESH"];
    }

    public function getPaymentMethods()
    {
        return Mage::getModel('\Model\Payment')->fetchAll();
    }

    public function getShippingMethods()
    {
        return Mage::getModel('\Model\Shipment')->fetchAll();
    }
}
