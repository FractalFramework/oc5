<?php
declare(strict_types=1);
ini_set('display_errors', '1');
error_reporting(E_ALL);
session_start();

require 'vendor/autoload.php';
require 'src/Common/lib.php';

$g = gets();

use App\Rooter;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/.env', __DIR__ . '/.env.local');
//echo $_ENV['BASE'];

$rooter = new Rooter();
$rooter->index($g);
