<?php

declare(strict_types=1);

require 'vendor/autoload.php';
require 'src/Lib/lib.php';

use App\Rooter;
use Symfony\Component\Dotenv\Dotenv;
use App\Lib\Php;
use App\Lib\Html;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/.env', __DIR__ . '/.env.local');
//echo $_ENV['BASE'];

$mt = microtime(true);

echo '
<link href="/src/css/core.css?' . $mt . '" rel="stylesheet" />';
echo '
<script src="/src/js/lib.js?' . $mt . '"></script>';
echo '
<script src="/src/js/ajax.js?' . $mt . '"></script>';
echo '
<script type="text/javascript">
state={"page":"home"};
var maintg="main"</script>';
echo "\n";

$rooter = new Rooter();
echo $rooter->test();
echo Html::div('', '', 'main');
//echo $rooter->home();

