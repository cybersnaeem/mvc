<?php

namespace Block\Core;

class Template
{   
    protected $template = null;
    protected $controller = null;
    protected $children = [];
    protected $message = null;
    protected $request= null;
    protected $url = null;
    protected $pager = null;

    public function __construct()
    {
        
        $this->setRequest();
        $this->setUrl();        
    }

    public function setPager(\Controller\Core\Pager $pager = null)
    {
        if (!$pager) {
            $pager = \Mage::getController('Controller\Core\Pager');
        }
        $this->pager = $pager;

        return $this;
    }

    public function getPager()
    {
        if (!$this->pager) {
            $this->setPager();
        }
        return $this->pager;
    }

    public function getChildren()
    {
        return $this->children;
    }
    public function setChildren($children = null)
    {
        $this->children = $children;
        return $this;
    }
    public function addChild(\Block\Core\Template $child,$key = null)
    {
        if(!$key){
            $key = get_class($child);
        }
        return $this->children[$key] =$child;
    }
    public function removeChild($key)
    {
        if(!array_key_exists($key,$this->children)){
            unset($this->children[$key]);
        }
        return $this;
    }
    public function createBlock($className)
    {
        return \Mage::getBlock($className,$this);
    }

    public function setUrl($url = null)
    {
        if(!$url){
            $url = \Mage::getModel("model\core\url");
        }
        $this->url = $url;
        return $this;

    }

    public function getUrl()
    {
        if(!$this->url){
            $this->setUrl();
        }
        return $this->url;
    }
    
    public function getChild($key)
    {
        if (!array_key_exists($key,$this->children)) 
        {
            return null;
        }
        return $this->children[$key];
    }
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this; 
    }
    
    public function getTemplate()
    {
        return $this->template;
    }
    public function toHtml()
    {
        ob_start();
        require_once("./View/".$this->getTemplate());
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function setRequest($request = null)
    {
        if(!$request){
            $request = \Mage::getModel("model\core\Request");
        }
        $this->request = $request;
        return $this;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getMessage()
    {
        return \Mage::getModel("model\admin\message");
    }

    public function baseUrl($subUrl = null)
    {
        return $this->getUrl()->baseUrl($subUrl);
    }
}
?>