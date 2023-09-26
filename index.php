<?php

declare(strict_types=1);

require 'vendor/autoload.php';
require 'src/public/lib.php';

use App\Models\Connect;
use App\Controllers\ArticleController;
use App\Controllers\CategoryController;
use App\Controllers\UserController;
use App\Entities\UserEntity;
use App\Pdo\User;

$db = new Connect();
$datas = $db->query('select name from users where id = 1', UserEntity::class);
pr($datas);

/*$datas = UserController::find(1);
pr($datas);

$datas = ArticleController::post(1);
pr($datas);

$datas = CategoryController::all();
pr($datas);

$datas = ArticleController::lasts();
pr($datas);*/
