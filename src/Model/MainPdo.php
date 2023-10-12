<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Db;

class MainPdo
{
    /*
    public static function query(
        string $sql,
        array $queries = [],
        string $class = '',
        int $one = 0
    ): object {
        if ($queries) {
            return Db::getDb()->prepare($sql, $queries, $class, $one);
        }
        return Db::getDb()->query($sql, $class);
    }
*/
    public function __get(string $key): string
    {
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();
        return $this->$key;
    }

}
