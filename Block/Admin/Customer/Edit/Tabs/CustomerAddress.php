<?php
namespace Block\Admin\Customer\Edit\Tabs;

class CustomerAddress extends \Block\Core\Edit
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/customer/edit/tabs/customerAddress.php");
    }

    public function setCustomerAddress($customers = null)
    {
        if (!$customers) {
            $customers = \Mage::getModel("Model\customer");
            if ($id = $this->getRequest()->getGet('id')) {
                $customer = $customers->load($id);
                if (!$customer) {
                    return null;
                }
            }
        }
        $this->customers = $customers;
        return $this;
    }

    public function getCustomerAddress()
    {
        if (!$this->customers) {
            $this->setCustomerAddress();
        }
        return $this->customers;
    }

    public function getAddressData($id, $type)
    {
        $customerAddress = \Mage::getModel("Model\CustomerAddress");
        $query = "SELECT * from customer_address where customerId = {$id} and addressType='{$type}'";
        if(!$customerAddress->fetchAll($query)){
            return $customerAddress;
        }
        return $customerAddress->fetchAll($query)->getData()[0];
    }

}
