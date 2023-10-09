<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Connect;

class Db
{
    private static ?object $db;

    public static function getDb(): object
    {
        if (!isset(self::$db)) {
            $params = self::params();
            self::$db = new Connect($params);
        }
        return self::$db;
    }

    private static function params(string $db = ''): array
    {
        return [
            'host' => $_ENV['HOST'],
            'user' => $_ENV['USER'],
            'pass' => $_ENV['PASS'],
            'base' => $db ? $db : $_ENV['BASE']
        ];
    }
}
