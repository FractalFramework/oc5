<?php
//ini_set('display_errors', '1');
//error_reporting(E_ALL);
//session_start();

declare(strict_types=1);

require 'vendor/autoload.php';
require 'src/Lib/lib.php';

//use App\Lib\Tests;
use App\Rooter;
use Symfony\Component\Dotenv\Dotenv;
use App\Lib\Php;
use App\Lib\Html;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/.env', __DIR__ . '/.env.local');
//echo $_ENV['BASE'];

$g = Php::gets();
$p = Php::posts();

$rooter = new Rooter;
$params = $g + $p;
pr($params);

//$com = Ses::get('com');
$com = $g['com'] ?? 'call'; //default
$ret = $rooter->$com($params);

if ($ret) {
    if (is_array($ret)) {
        header('Content-Type: application/json');
        $ret = json_encode($ret, JSON_HEX_TAG);
    } else
        header('Content-Type: text/html; charset=utf-8');
    echo $ret;
}
