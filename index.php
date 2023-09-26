<?php

declare(strict_types=1);

require 'vendor/autoload.php';
//require 'src/pub/lib.php';

use App\Pub\Tests;
use App\Pub\Root;

$main = new Tests();
//echo $main->call();

$root = new Root();
echo $root->home();
