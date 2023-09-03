<?php
#dav@2023 ©All rights reserved
//ini_set('session.cookie_lifetime',0);
//ini_set('session.use_only_cookies','on');
//ini_set('session.use_strict_mode','on');
//ini_set('default_charset','utf-8');
ini_set('display_errors','1');
error_reporting(E_ALL);
session_start();
//header('Content-Type: text/html; charset=utf-8');
//define('root',__DIR__);
require('src/lib.php');
require('cnfg/'.nohttp(host()).'.php');
require('public/index.php');
sql::$qr=null;
?>