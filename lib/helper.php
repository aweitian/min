<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/5
 * Time: 16:45
 */
function requestUri()
{
    if (isset($_SERVER['HTTP_X_REWRITE_URL'])) {
        $uri = $_SERVER['HTTP_X_REWRITE_URL'];
    } elseif (isset($_SERVER['REQUEST_URI'])) {
        $uri = $_SERVER['REQUEST_URI'];
    } elseif (isset($_SERVER['ORIG_PATH_INFO'])) {
        $uri = $_SERVER['ORIG_PATH_INFO'];
        if (!empty($_SERVER['QUERY_STRING'])) {
            $uri .= '?' . $_SERVER['QUERY_STRING'];
        }
    } else {
        $uri = '';
    }
    return $uri;
}