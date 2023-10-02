<?php

declare(strict_types=1);
namespace App\Controllers;


use App\Models\Main;
use App\Models\Db;
use App\Entities\ArticleEntity;

class ArticleController extends Main
{
    protected static string $table = 'posts';

    public static function post(int $id): object
    {
        $sql = 'select id,title,content from ' . self::$table . ' where id=?';
        $class = ArticleEntity::class;
        $one_result = 1;
        $blind = [$id];
        return self::query($sql, $blind, $class, $one_result);
    }

    public static function all(): array
    {
        $sql = 'select ' . self::$table . '.id,title,content,category
        from ' . self::$table . '
        left join cats
        on cats.id=catid
        order by ' . self::$table . '.up desc';
        return self::query($sql, [], ArticleEntity::class);
    }

    public static function lasts(): array
    {
        $sql = 'select ' . self::$table . '.id,title,content,category
        from ' . self::$table . '
        left join cats
        on cats.id=catid
        limit 10';
        $class = ArticleEntity::class;
        $one_result = 0;
        $blind = [];
        return self::query($sql, $blind, $class, $one_result);
    }

    public static function artByCat($catid): object
    {
        $sql = 'select ' . self::$table . '.id,title,content,category
        from ' . self::$table . '
        left join cats
        on cats.id=catid
        where catid=?
        order by ' . self::$table . '.up desc';
        $blind = [$catid];
        return self::query($sql, $blind);
    }

    public static function categories(): object
    {
        $sql = 'select id,title,content from ' . self::$table . ' where id=?';
        $blind = [1];
        $class = ArticleEntity::class;
        $one_result = 0;
        return self::query($sql, $blind, $class, $one_result);
    }

}
