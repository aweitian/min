<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/13
 * Time: 16:07
 */

namespace app\Controller;


use lib\Container;

class Controller
{
    /**
     * @var Container $app
     */
    protected $app;

    /**
     * Controller constructor.
     * @param Container $app
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public static function check(Container $app)
    {
        return $app->make('default_gate');
    }
}