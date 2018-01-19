<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/12
 * Time: 14:40
 */
namespace app\Provider;

abstract class Provider
{
    /**
     * @var \lib\Container $app
     */
    protected $app;

    public function __construct(\lib\Container $app)
    {
        $this->app = $app;
    }
}