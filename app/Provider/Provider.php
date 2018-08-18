<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/12
 * Time: 14:40
 */
namespace app\Provider;

use lib\Container;

abstract class Provider
{
    /**
     * @var Container $app
     */
    protected $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }
}