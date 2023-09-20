<?php

declare(strict_types=1);
namespace App\Controllers;

use App\Models\Main;
use App\Entities\UserEntity;

class UserController extends Main
{

    protected static string $table = 'users';

    public static function find(int $id): object
    {
        $sql = 'select name from ' . self::$table . ' where id=?';
        $class = UserEntity::class;
        $blind = [$id];
        $one_result = 1;
        return self::query($sql, $blind, $class, $one_result);
    }

}
