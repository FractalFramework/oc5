<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\MainPdo;
use App\Entities\CategoryEntity;

class CategoryService extends MainPdo
{
    protected static string $table = 'cats';

    public static function allCategories(): array
    {
        $sql = 'select id,category from ' . self::$table . '';
        $class = CategoryEntity::class;
        return self::query($sql, [], $class, 0);
    }

    public static function findCategoryFromId(int $id): object
    {
        $sql = 'select category from ' . self::$table . ' where id=?';
        $class = CategoryEntity::class;
        $blind = [$id];
        $one_result = 1;
        return self::query($sql, $blind, $class, $one_result);
    }

}
