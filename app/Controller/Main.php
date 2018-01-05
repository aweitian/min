<?php
namespace app\Controller;

use lib\Container;

class Main
{
    public static function check(Container $app)
    {
//        $app->make('aa');
        return true;
    }
    public function index()
    {
        echo "hello world.";
    }
    public function notfound()
    {
        echo "hello world.";
    }
}