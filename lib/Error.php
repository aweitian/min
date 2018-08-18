<?php
/**
 * Created by PhpStorm.
 * User: awei.tian
 * Date: 4/6/18
 * Time: 1:29 PM
 */

namespace lib;


class Error
{
    protected $error = array();
    protected $message = "";
    protected $level = 0;//0 normal,1 error

    public function getLastInfo()
    {
        if ($this->hasError()) {
            return $this->getLastErr();
        }
        return $this->getMessage();
    }

    public function setMessage($msg)
    {
        $this->message = $msg;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function hasError()
    {
        return $this->level == 1;
    }

    public function addError($err)
    {
        $this->level = 1;
        if ($err instanceof \Exception) {
            $err = 'Msg:' . $err->getMessage() . "<br>File:" . $err->getFile() . '<br>Line:' . $err->getLine();
        } else if (!is_string($err)) {
            return;
        }
        $this->error[] = $err;
    }

    public function getLastErr()
    {
        return end($this->error);
    }

    public function getAllError($separator = "<br>")
    {
        return join($separator, $this->error);
    }
}