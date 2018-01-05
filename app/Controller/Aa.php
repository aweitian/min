<?php
namespace app\Controller;

use lib\Container;
use lib\Router;

class Aa
{
    public static function check(Container $app)
    {
//        $app->make('aa');
        return true;
    }
    public function index(Container $app)
    {
        /**
         * @var Router $router
         */
        $router = $app->make("router");
        echo $router->namespace;
    }
    public function notfound()
    {
        echo "hello world.";
    }
}