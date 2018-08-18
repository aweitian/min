<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/13
 * Time: 10:00
 */

namespace lib;


class Session
{
    public function __construct($path)
    {
        session_save_path($path);
        session_start();
    }


    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function has($id)
    {
        return array_key_exists($id, $_SESSION);
    }

    public function get($id)
    {
        if (isset($_SESSION[$id])) {
            return $_SESSION[$id];
        }
        return null;
    }

    public function remove($id)
    {
        if (isset($_SESSION[$id])) {
            unset($_SESSION[$id]);
        }
    }

    public function clear()
    {
        $_SESSION = array();
    }
}