<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/6
 * Time: 9:28
 */
/**
 * @var \lib\Dotnet $dotnet
 */
$dotnet = $this->app->make('dotnet');
$info = $dotnet->load();
return array(
    'host' => $info['DB_HOST'],
    'port' => $info['DB_PORT'],
    'user' => $info['DB_USER'],
    'password' => $info['DB_PASS'],
    'charset' => $info['DB_CHARSET'],
    'database' => $info['DB_NAME']
);