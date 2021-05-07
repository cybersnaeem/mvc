<?php

namespace Block\Admin\Shipment\Edit\Tabs;


class Form extends \Block\Core\Edit
{
    protected $shipments = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/shipment/edit/tabs/form.php");
    }

      public function setShipment($shipments = null)
      {
          if (!$shipments) 
          {
              $shipments = \Mage::getModel("Model\shipment");
              if ($id = $this->getRequest()->getGet('id')) 
              {
                  $shipment = $shipments->load($id);
                  if (!$shipment) {
                      return null;
                  }
              }  
          }
          $this->shipments = $shipments;
          return $this;
      }
      public function getShipment()
      {
          if (!$this->shipments) {
              $this->setShipment();
          }
          return $this->shipments;     
      }  

}
