<?php

namespace Controller\Core;

class Front{
    public static function init()
    {
        $request = \Mage::getModel('model\core\request');
        
        $controllerName = ucwords($request->getControllerName());
        $actionName = $request->getActionName()."Action";
        $controllerClassName = \Mage::prepareClassName('Controller',$controllerName);
        $controller = \Mage::getController($controllerClassName);
        $controller->$actionName();
    }
}

?>