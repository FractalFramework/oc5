<?php

declare(strict_types=1);
namespace App\Models;

use App\Models\Db;

class Main
{

    private static string $site = 'poo';

    public static function query(
        string $sql,
        array $queries = [],
        string $class = '',
        int $one = 0
    ): object|array {
        if ($queries) {
            return Db::getDb()->prepare($sql, $queries, $class, $one);
        }
        return Db::getDb()->query($sql, $class);
    }

    public function __get($key): string
    {
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();
        return $this->$key;
    }

    public function getTitle(): string
    {
        return self::$site;
    }

    public function setTitle($t): string
    {
        return self::$site = $t;
    }

}
