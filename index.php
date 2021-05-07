<?php

//filter_alt
//993314596

spl_autoload_register(__NAMESPACE__."\Mage::loadClassByFileName");

class Mage {
    
    public static function init()
    {
        self::getController("controller\Core\Front");
        \Controller\Core\Front::init();            
    }
    
    public static function prepareClassName($key,$namespace)
    {
        $className = $key.' '.$namespace;
        $className = str_replace('\\',' ',$className); 
        $className = ucwords($className);
        $className = str_replace(' ','\\',$className);
        return $className;
    }

    public static function getModel($className)
    {
        //self::loadClassByFileName($className);

        $className = str_replace('\\',' ',$className);
        $className = ucwords($className);
        $className = str_replace(' ','\\',$className);
        return new $className;
    }
    
    public static function getBlock($className)
    {
        //self::loadClassByFileName($className);

        $className = str_replace('\\',' ',$className);
        $className = ucwords($className);
        $className = str_replace(' ','\\',$className);
        return new $className();
        //new Front();
    }

    public static function getController($className)
    {
        //self::loadClassByFileName($className);

        $className = str_replace('\\',' ',$className);
        $className = ucwords($className);
        $className = str_replace(' ','\\',$className);
        return new $className;
        //new Front();
    }
    
    public static function loadClassByFileName($className)
    {
        $className = str_replace('\\',' ',$className);
        $className = ucwords($className);
        $className = str_replace(' ','\\',$className);
        $className = $className.'.php';
        
        //Controller/Core/Front.php
        require_once($className);
    }

}

Mage::init();

?>