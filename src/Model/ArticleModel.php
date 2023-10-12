<?php

declare(strict_types=1);

namespace App\Model;

class ArticleModel
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function specifyDatas(array $datas): array //ArticleModel//ArticleEntity
    {
        $articles = [];
        foreach ($datas as $k => $obj) {
            $articles[] = [
                'id' => $obj->id,
                'title' => $obj->category,
                'excerpt' => $obj->excerpt,
                'category' => $obj->category,
            ];
        }
        $array['results'] = $articles;
        return $array;
    }

}
