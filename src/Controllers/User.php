<?php

declare(strict_types=1);
namespace App\Controllers;

use App\Models\Main;

class User extends Main
{

    protected static string $table = 'users';

    public static function find(int $id): object
    {
        $sql = 'select name from ' . self::$table . ' where id=?';
        $class = '\App\Pdo\User';
        $blind = [$id];
        $one_result = 1;
        return self::query($sql, $blind, $class, $one_result);
    }

}
