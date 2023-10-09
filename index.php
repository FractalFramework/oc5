<?php
//session_start();

declare(strict_types=1);

require 'vendor/autoload.php';
require 'src/Lib/common.php';

$g = gets();

use App\Rooter;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/.env', __DIR__ . '/.env.local');
//echo $_ENV['BASE'];

$rooter = new Rooter();
$rooter->index($g);
