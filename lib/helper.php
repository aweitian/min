<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/5
 * Time: 16:45
 */
define('DEFAULT_CONTROL', 'main');
define('DEFAULT_ACTION', 'index');
define('ROUTE_NAME', 'r');
define('ROUTE_SEPARATOR', '.');
function getAction()
{
    if (isset($_GET[ROUTE_NAME])) {
        $path = $_GET[ROUTE_NAME];
    } else {
        $path = '';
    }
    $path = trim($path, ROUTE_SEPARATOR);
    $arr = explode(ROUTE_SEPARATOR, $path);
    switch (count($arr)) {
        case 0:
            $ctl = DEFAULT_CONTROL;
            $act = DEFAULT_ACTION;
            break;
        case 1:
            $ctl = $arr[0];
            $act = DEFAULT_ACTION;
            $ctl = preg_replace("/[^\w]/", "", $ctl);
            if ($ctl == "") {
                $ctl = DEFAULT_CONTROL;
            }
            break;
        default:
            $ctl = $arr[0];
            $act = $arr[1];
            $ctl = preg_replace("/[^\w]/", "", $ctl);
            if ($ctl == "") {
                $ctl = DEFAULT_CONTROL;
            }
            $act = preg_replace("/[^\w]/", "", $act);
            if ($act == "") {
                $act = DEFAULT_ACTION;
            }
            break;
    }
    return array(
        'ctl' => $ctl,
        'act' => $act
    );
}

function arr_get($arr,$key)
{
    if (is_string($key) && array_key_exists($key,$arr))
    {
        return $arr[$key];
    }
    return null;
}

function get_current_url()
{
    $url = 'http://';
    if (isset ($_SERVER ['HTTPS']) && $_SERVER ['HTTPS'] == 'on') {
        $url = 'https://';
    }
    if ($_SERVER ['SERVER_PORT'] != (isset ($_SERVER ['HTTPS']) && $_SERVER ['HTTPS'] == 'on' ? '443' : '80')) {
        $url .= $_SERVER ['SERVER_NAME'] . ':' . $_SERVER ['SERVER_PORT'] . $_SERVER ['REQUEST_URI'];
    } else {
        $url .= $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'];
    }
    return $url;
}

function getIp()
{
    return getenv("REMOTE_ADDR");
}

function getUa()
{
    $ua = new \lib\UserAgent();
    return $ua->agent;
}

function u($action = null, $control = null)
{
    $ca = getAction();
    if ($action != null) {
        $ca['act'] = $action;
    }
    if ($control != null) {
        $ca['ctl'] = $control;
    }
    if ($ca['ctl'] == DEFAULT_CONTROL && $ca['act'] == DEFAULT_ACTION) {
        return '';
    } else if ($ca['act'] == DEFAULT_ACTION) {
        return ROUTE_NAME . "=" . $ca['ctl'];
    } else {
        return ROUTE_NAME . "=" . $ca['ctl'] . ROUTE_SEPARATOR . $ca['act'];
    }

}

function utf8_output($string)
{
    echo '<meta content="text/html; charset=utf-8" http-equiv="content-type" />';
    echo $string;
}

function get_rand_char($length = 4) {
    $str = "";
    $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    $max = strlen ( $strPol ) - 1;

    for($i = 0; $i < $length; $i ++) {
        $str .= $strPol [rand ( 0, $max )];
    }

    return $str;
}

if (!function_exists("array_column")) {
    function array_column(array $array, $column_key, $index_key = null)
    {
        $result = array();
        foreach ($array as $arr) {
            if (!is_array($arr)) continue;

            if (is_null($column_key)) {
                $value = $arr;
            } else {
                $value = $arr[$column_key];
            }

            if (!is_null($index_key)) {
                $key = $arr[$index_key];
                $result[$key] = $value;
            } else {
                $result[] = $value;
            }
        }
        return $result;
    }
}

