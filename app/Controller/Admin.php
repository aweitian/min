<?php

namespace app\Controller;

use app\Provider\Reward;
use app\Provider\Session;
use app\Provider\Share;
use app\Provider\User;
use lib\View;


class Admin extends Controller
{
    /**
     * @throws \Exception
     */
    public function index()
    {
        /**
         * @var View $view
         */
        $view = $this->app->make('view');
        print $view->render('index');
    }
}