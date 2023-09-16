<?php

declare(strict_types=1);

$root = dirname(dirname(__DIR__));
require $root . '/vendor/autoload.php';

use App\Models\Connect;
use App\Controllers\Article;
use App\Controllers\Category;
use App\Controllers\User;

$db = new Connect();
$datas = $db->query('select name from users where id = 1', '\App\Pdo\User');
print_r($datas);

$datas = User::find(1);
print_r($datas);

$datas = Article::post(1);
print_r($datas);

$datas = Category::all();
print_r($datas);
