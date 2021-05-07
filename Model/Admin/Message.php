<?php

namespace Model\Admin;

\Mage::loadClassByFileName("Model\Admin\Session");

class Message extends Session{

    public function __construct()
    {
        parent::__construct();
    }

    public function setSuccess($message)
    {
        $this->success = $message;    
        return $this;
    }

    public function getSuccess()
    {
        return $this->success;
    }

    public function setFailure($message)
    {
        $this->failure = $message;
        return $this;
    }

    public function getFailure()
    {
        return $this->failure;
    }

    public function clearSuccess()
    {
        unset($this->success);
    }

    public function clearFailure()
    {
        unset($this->failure);
    }

}

?>