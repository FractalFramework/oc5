<?php

declare(strict_types=1);
namespace App\Controllers;

use App\Entities\CategoryEntity;

use App\Models\Main;

class CategoryController extends Main
{

    protected static string $table = 'cats';

    public static function all(): array
    {
        $sql = 'select id,category from ' . self::$table . '';
        $class = CategoryEntity::class;
        return self::query($sql, [], $class, 0);
    }

    public static function find(int $id): object
    {
        $sql = 'select category from ' . self::$table . ' where id=?';
        $class = CategoryEntity::class;
        $blind = [$id];
        $one_result = 1;
        return self::query($sql, $blind, $class, $one_result);
    }

}
