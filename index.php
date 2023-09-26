<?php

declare(strict_types=1);

require 'vendor/autoload.php';
//require 'src/pub/lib.php';

use App\Pub\Tests;
use App\Pub\Root;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

//echo getenv('S3_BUCKET');
echo $_ENV['LIB'];

$main = new Tests();
//echo $main->call();

$root = new Root();
echo $root->home();
