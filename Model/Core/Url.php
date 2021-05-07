<?php

namespace Model\Core;

class Url {
    protected $request=null;
 
    public function __construct(){
     
        $this->setRequest(); 
    }


    public function setRequest(){

        $this->request = \Mage::getModel('model\core\Request');
        
        return $this;

    }
    public function getRequest(){
        return $this->request;

    }

    public function getUrl($actionName = NULL,$controllerName = NULL, $params=NULL,$resetParams=false){ 

        $final=$_GET;
        if($resetParams){
            $final=[];
        }

        if($actionName == NULL){
            $actionName=$_GET['a'];
        }
        if($controllerName == NULL){
            $controllerName=$_GET['c'];

        }

        $final['c']=$controllerName;
        $final['a']=$actionName;
        if(is_array($params)){
            $final=array_merge($final,$params);
        }
       
        $queryString=http_build_query($final);
        unset($final);
        
        return "http://localhost/cybercommain/index.php?{$queryString}";
    }

    public function baseUrl($subUrl = null)
    {
        $url = "http://localhost/cybercommain/";
        if ($subUrl) {
            $url .= $subUrl;
        }
        return $url;
    }
}

?>