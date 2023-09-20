<?php

declare(strict_types=1);

$root = dirname(dirname(__DIR__));
require $root . '/vendor/autoload.php';

use App\Models\Connect;
use App\Controllers\Article;
use App\Controllers\Category;
use App\Controllers\UserController;
use App\Pdo\User;

$db = new Connect();
$datas = $db->query('select name from users where id = 1', User::class);
print_r($datas);

/*$datas = UserController::find(1);
print_r($datas);

$datas = Article::post(1);
print_r($datas);

$datas = Category::all();
print_r($datas);

$datas = Article::lasts();
print_r($datas);*/
