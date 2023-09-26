<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);
session_start();
require 'vendor/autoload.php';
require 'src/public/lib.php';
//require('cnfg/' . nohttp(host()) . '.php');
$g = gets();
$p = posts();
//boot::call();
$com = get('com');
[$app, $mth] = expl(',', $com);
//$no = blocks::secure($app, $mth);
if (!$no && method_exists($app, $mth))
    $ret = $app::$mth($p);
if (isset($ret)) {
    if (is_array($ret)) {
        header('Content-Type: application/json');
        $ret = json_encode($ret, JSON_HEX_TAG);
    } else
        header('Content-Type: text/html; charset=utf-8');
    echo $ret;
}
?>

