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

    public function dispatch($ctl, $act, $namespace = null, $input = array())
    {
        if (!is_null($namespace)) {
            $this->namespace = $namespace;
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
                $this->error("没有权限!");
                return;
            }
        }

        if ($rc->hasMethod($act)) {
            if ($rc->hasMethod("__construct")) {
                $controller = $rc->newInstance($this->container);
            } else {
                $controller = $rc->newInstance();
            }
            $method = $rc->getMethod($act);
            $method->invokeArgs($controller, $input);
        } else {
            $this->_404();
            return;
        }
    }

    public function info($info)
    {
        $content = file_get_contents(__DIR__ . "/../resource/info.html");
        print str_replace("{info}", $info, $content);
        exit;
    }

    public function debug($info)
    {
        $content = file_get_contents(__DIR__ . "/../resource/debug.html");
        print str_replace("{debug}", $info, $content);
        exit;
    }

    public function _404()
    {
        if (PHP_SAPI == 'cli') {
            exit('command not found');
        }
        $content = file_get_contents(__DIR__ . "/../resource/404.html");
        print $content;
        exit;
    }

    public function error($error)
    {
        $content = file_get_contents(__DIR__ . "/../resource/error.html");
        print str_replace("{error}", $error, $content);
        exit;
    }
}