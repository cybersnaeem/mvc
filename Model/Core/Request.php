<?php

namespace Model\Core;

class Request{
    public function isPost()
    {
        if($_SERVER["REQUEST_METHOD"] != "POST"){
            return false;
        }
        return true;
    }
    public function getPost($key = null,$optional = null)
    {
        if(!$key){
            return $_POST;
        }
        if(!array_key_exists($key,$_POST)){
            return $optional;
        }
        return $_POST[$key];
    }
    public function getGet($key = null,$optional = null)
    {
        if(!$key){
            return $_GET;
        }
        if(!array_key_exists($key,$_GET)){
            return $optional;
        }
        return $_GET[$key];
    }
    public function getControllerName()
    {
        return $this->getGet('c','index');
    }
    public function getActionName()
    {
        return $this->getGet('a','index');
    }
}

?>