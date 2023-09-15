<?php

declare(strict_types=1);
namespace App\Models;

use App\Models\Connect;

class Db
{
    private static array $params = ['host' => 'localhost', 'user' => 'root', 'pass' => 'dev', 'base' => 'oc5'];
    private static string $db = '';

    public static function getDb()
    {
        if (!self::$db) {
            self::$db = new Connect(self::$params);
        }
        return self::$db;
    }

}
