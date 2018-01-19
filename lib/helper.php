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

