<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/13
 * Time: 10:00
 */

namespace app\Provider;


use lib\Container;

class Session extends Provider
{
    public function __construct(Container $app)
    {
        parent::__construct($app);
        session_save_path(__DIR__."/../../storage/session");
        session_start();
    }


    public function setOpenid($id)
    {
        $_SESSION['user.openid'] = $id;
    }

    /**
     * 从首页转跳过去
     */
    public function setViaIndex()
    {
        $_SESSION['main.direct'] = 1;
    }

    public function isViaIndex()
    {
        return isset($_SESSION['main.direct']);
    }

    public function getOpenid()
    {
        if (isset($_SESSION['user.openid']))
        {
            return $_SESSION['user.openid'];
        }
        return null;
    }

    public function reset()
    {
        unset($_SESSION['main.direct']);
        unset($_SESSION['user.openid']);
    }
}