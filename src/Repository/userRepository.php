<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\MainPdo;
use App\Entity\UserEntity;

class UserRepository extends MainPdo
{
    protected static string $table = 'users';

    public static function findUserFromId(int $id): object
    {
        $sql = 'select name from ' . self::$table . ' where id=?';
        $class = UserEntity::class;
        $blind = [$id];
        $one_result = 1;
        return self::query($sql, $blind, $class, $one_result);
    }

}
