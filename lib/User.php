<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/20
 * Time: 18:38
 */

namespace lib;

use Exception;

class User
{
    const ROLE_SUPERUSER = 'superuser';
    const ROLE_ADMIN = 'admin';

    protected $session_key = 'admin_session_key';
    /**
     * @var Container
     */
    protected $app;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var Connection
     */
    protected $connection;

    /**
     * User constructor.
     * @throws Exception
     */
    public function __construct()
    {
        global $app;
        $this->app = $app;
        $this->session = $app->make("session");
    }

    public function calcPwd($pwd)
    {
        return md5('#$67243jfFG9iu' . $pwd);
    }

    public function isLogined()
    {
        return $this->session->has($this->session_key);
    }

    public function getRole()
    {
        $info = $this->getInfo();
        return isset($info['role']) ? $info['role'] : null;
    }

    public function isAdmin($strict = false)
    {
        if ($strict) {
            return $this->getRole() == self::ROLE_ADMIN;
        } else {
            return $this->getRole() == self::ROLE_ADMIN || $this->getRole() == self::ROLE_SUPERUSER;
        }
    }

    public function isSupperUser()
    {
        $info = $this->getInfo();
        if ($info) {
            return $info['role'] == self::ROLE_SUPERUSER;
        }
        return false;
    }

    public function getInfo()
    {
        return $this->session->get($this->session_key);
    }


    public function getUid()
    {
        $info = $this->getInfo();
        if ($info) {
            return $info['uid'];
        }
        return null;
    }


    public function getName()
    {
        $info = $this->getInfo();
        if ($info) {
            return $info['name'];
        }
        return null;
    }

    public function auth($name, $pass)
    {
        $env = $this->app->make('env');
        if ($env['superuser'] == $name && $this->calcPwd($pass) == $env['superpass']) {
            $this->_auth(self::ROLE_SUPERUSER, 0, $name);
            return true;
        }
        $row = $this->connection->fetch("select * from admin WHERE `name` = :code", array('code' => $name));
        if ($row) {
            if ($row['pass'] == $this->calcPwd($pass)) {
                $this->_auth(self::ROLE_ADMIN, $row['admin_id'], $name);
                return true;
            }
        }
        return false;
    }

    protected function _auth($role, $uid, $name)
    {
        $this->_save_session(compact('role', 'uid', 'name'));
    }

    protected function _save_session(array $data)
    {
        $this->session->set($this->session_key, $data);
    }

    public function logout()
    {
        $this->session->remove($this->session_key);
    }
}