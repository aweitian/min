<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/18
 * Time: 10:27
 */

namespace app\Console;


use lib\User;

class Pass
{
    public function index($pass = null)
    {
        if (is_null($pass)) {
            print "php artisan Pass 123";
            exit;
        }
        $user = new User();
        print $user->calcPwd($pass);
    }
}