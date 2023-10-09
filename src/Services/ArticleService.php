<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\MainPdo;
use App\Entities\ArticleEntity;

class ArticleService extends MainPdo
{
    protected static string $table = 'posts';

    public function articleById(int $id): object
    {
        $sql = 'select id,title,content from ' . self::$table . ' where id=?';
        $class = ArticleEntity::class;
        $one_result = 1;
        $blind = [$id];
        return self::query($sql, $blind, $class, $one_result);
    }

    public function allArticles(): object
    {
        $sql = 'select ' . self::$table . '.id,title,content,category
        from ' . self::$table . '
        left join cats
        on cats.id=catid
        order by ' . self::$table . '.up desc';
        return self::query($sql, [], ArticleEntity::class);
    }

    public function lastsArticles(): object
    {
        $sql = 'select ' . self::$table . '.id,title,content,category
        from ' . self::$table . '
        left join cats
        on cats.id=catid
        limit 10';
        $class = ArticleEntity::class;
        $one_result = 0;
        return self::query($sql, [], $class, $one_result);
    }

    public function ArticlesByCategory(int $catid = 1): object
    {
        $sql = 'select ' . self::$table . '.id,title,content,category
        from ' . self::$table . '
        left join cats
        on cats.id=catid
        where catid=?
        order by ' . self::$table . '.up desc';
        $blind = [$catid];
        $class = ArticleEntity::class;
        $one_result = 0;
        return self::query($sql, $blind, $class, $one_result);
    }

    public function categories(): object
    {
        $sql = 'select id,title,content from ' . self::$table . ' where id=?';
        $blind = [1];
        $class = ArticleEntity::class;
        $one_result = 0;
        return self::query($sql, $blind, $class, $one_result);
    }

}
