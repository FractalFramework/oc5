<?php

declare(strict_types=1);

namespace App\Model;

use App\Entity\ArticleEntity;

class ArticleModel
{
    public int $uid;
    public string $title;
    public string $content;
    public string $excerpt;
    public string $category;
    public string $name;
    public string $date;
    public int $pub;
    public array $results;

    private function __construct()
    {
    }

    public static function fromFetch(ArticleEntity $entity): self
    {
        $articleModel = new self();
        $articleModel->uid = $entity->uid;
        $articleModel->title = $entity->title;
        $articleModel->content = $entity->content;
        $articleModel->excerpt = $entity->excerpt;
        $articleModel->category = $entity->category;
        $articleModel->name = $entity->name;
        $articleModel->date = $entity->date;
        $articleModel->pub = $entity->pub;
        return $articleModel;
    }

    public static function fromFetchAll(ArticleEntity $entity): self
    {
        $articleModel = new self();
        $articleModel->uid = $entity->uid;
        $articleModel->title = $entity->title;
        $articleModel->content = nl2br($entity->content);
        $articleModel->excerpt = $entity->excerpt;
        $articleModel->category = $entity->category;
        $articleModel->name = $entity->name;
        $articleModel->date = $entity->date;
        $articleModel->pub = $entity->pub;
        return $articleModel;
    }
}
