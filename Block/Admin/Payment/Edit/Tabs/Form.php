<?php

namespace Block\Admin\Payment\Edit\Tabs;


class Form extends \Block\Core\Edit
{
    protected $payments = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/payment/edit/tabs/form.php");
    }

    public function setPayment($payments = null)
    {
        if (!$payments) 
        {
            $payments = \Mage::getModel("Model\payment");
            if ($id = $this->getRequest()->getGet('id')) 
            {
                $payment = $payments->load($id);
                if (!$payment) {
                    return null;
                }
            }  
        }
        $this->payments = $payments;
        return $this;
    }
    public function getPayment()
    {
        if (!$this->payments) {
            $this->setPayment();
        }
        return $this->payments;     
    }  
}
