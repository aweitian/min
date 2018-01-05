<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/5
 * Time: 15:56
 */
require_once "lib/helper.php";
spl_autoload_register(function ($class) {
    if (file_exists($class . ".php")) {
        include_once $class . ".php";
    }
});
$app = new \lib\Container();
$app->instance("app",$app);
$router = new \lib\Router($app);
$app->instance("router",$router);


$router->dispatch(requestUri());
