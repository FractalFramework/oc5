<?php

declare(strict_types=1);

require 'vendor/autoload.php';
require 'src/Lib/lib.php';

//use App\Lib\Tests;
use App\Rooter;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();

// you can also load several files
$dotenv->load(__DIR__ . '/.env', __DIR__ . '/.env.local');

//echo getenv('S3_BUCKET');
echo $_ENV['BASE'];

//$main = new Tests();
//echo $main->call();

$root = new Rooter();
echo $root->home();
