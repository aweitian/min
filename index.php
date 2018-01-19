<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/5
 * Time: 15:56
 */
error_reporting(E_ALL);
ini_set("display_errors", "On");
require_once "lib/helper.php";
spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    if (file_exists($class . ".php")) {
        include_once $class . ".php";
    }
});
$app = new \lib\Container();

$router = new \lib\Router($app);
$app->instance("dotnet",  new \lib\Dotnet(__DIR__."/.env"));
$config = new \lib\Config($app);
$config->loadFiles(__DIR__ . "/config");

//初始化容器
$app->instance("default_gate", true);//默认可以访问所有PUBLIC 的CONTROL->ACTION
$app->instance("app", $app);
$app->instance("router", $router);
$app->instance("config", $config);

//延迟加载
$app->single("log", function () use ($app) {
    return new \lib\Log(__DIR__ . "/storage/logs");
});
$app->single("session", function () use ($app) {
    return new \app\Provider\Session($app);
});
$app->single("cache", function () use ($app) {
    return new \lib\FileCache(__DIR__ . '/storage/cache');
});

$app->single("connection", function () use ($app) {
    return new \lib\Connection($app->make("config")->get("db"));
});

$app->single("view", function () use ($app) {
    return new \lib\View(__DIR__."/resource");
});
$ca = getAction();
$router->dispatch($ca['ctl'], $ca['act']);
