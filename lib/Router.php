<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/5
 * Time: 16:17
 */

namespace lib;


class Router
{
    /**
     * @var Container $container
     */
    public $container;
    public $namespace = "\\app\\Controller\\";
    public $default_control = 'main';
    public $default_action = 'index';

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function dispatch($path)
    {
        $path = trim($path, "/");
        $arr = explode("/", $path);
        switch (count($arr)) {
            case 0:
                $ctl = $this->default_control;
                $act = $this->default_action;
                break;
            case 1:
                $ctl = $arr[0];
                $act = $this->default_action;
                $ctl = $this->clean($ctl);
                if ($ctl == "") {
                    $ctl = $this->default_control;
                }
                break;
            default:
                $ctl = $arr[0];
                $act = $arr[1];
                $ctl = $this->clean($ctl);
                if ($ctl == "") {
                    $ctl = $this->default_control;
                }
                $act = $this->clean($act);
                if ($act == "") {
                    $act = $this->default_action;
                }
                break;
        }

        $cls = $this->namespace . ucfirst(strtolower($ctl));
        if (!class_exists($cls)) {
            $this->_404();
            return;
        }
        $rc = new \ReflectionClass($cls);

        if ($rc->hasMethod('check') && $rc->getMethod('check')->isStatic()) {
            $privilege = call_user_func_array(
                $cls . "::check",
                array(
                    $this->container
                )
            );
            if ($privilege !== true) {
                $this->_401();
                return;
            }
        }

        if ($rc->hasMethod($act)) {
            $controller = $rc->newInstance();
            $method = $rc->getMethod($act);
            $method->invokeArgs($controller, array($this->container));
        }
    }

    protected function clean($str)
    {
        return preg_replace("/[^\w]/", "", $str);
    }

    public function _404()
    {
        echo "404";
        exit;
    }

    public function _401()
    {
        echo "401";
        exit;
    }
}