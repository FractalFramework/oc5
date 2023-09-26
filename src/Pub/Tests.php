<?php

declare(strict_types=1);

namespace App\Pub;

use App\Models\Connect;
use App\Controllers\ArticleController;
use App\Controllers\CategoryController;
use App\Controllers\UserController;
use App\Entities\UserEntity;
use App\Pdo\User;

class Tests
{
    function __construct()
    {
        require_once 'src/pub/lib.php';
    }

    public function call()
    {

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
    }
}
