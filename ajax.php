<?php
//ini_set('display_errors', '1');
//error_reporting(E_ALL);
declare(strict_types=1);
session_start();

require 'vendor/autoload.php';
require 'src/Common/lib.php';

use App\Rooter;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/.env', __DIR__ . '/.env.local');

$g = gets();
$p = posts();

$rooter = new Rooter;
$params = $g + $p;
$ret = $rooter->index($params);

/*if ($ret) {
    if (is_array($ret)) {
        header('Content-Type: application/json');
        $ret = json_encode($ret, JSON_HEX_TAG);
    } else
        header('Content-Type: text/html; charset=utf-8');
    echo $ret;
}*/
