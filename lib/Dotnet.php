<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 13:37
 */

namespace lib;
class Dotnet
{
    protected $path;
    public function __construct($path='')
    {
        if ($path)
        {
            $this->path = $path;
        }
    }

    public function load($path=null)
    {
        if (is_null($path))
        {
            $path = $this->path;
        }
        $ret = array();
        if ($path && file_exists($path)) {
            foreach (file($path) as $line) {
                $line = trim("$line");
                $arr = explode("=", $line, 2);
                $key = trim($arr[0]);
                if (count($arr) == 2) {
                    $ret[$key] = $this->clean(trim($arr[1]));
                } else {
                    $ret[$key] = null;
                }
            }
        }
        return $ret;
    }

    protected function clean($line)
    {
        if (!$line) return null;
        if (substr($line, 0, 1) == '"' && substr($line, -1, 1) == '"') {
            return substr($line, 1, -1);
        } else if (substr($line, 0, 1) == "'" && substr($line, -1, 1) == "'") {
            return substr($line, 1, -1);
        }
        return $line;
    }
}