<?php

declare(strict_types=1);

namespace App\Model;

use App\Entity\ArticleEntity;

class ArticleModel
{
    public string $title;
    public string $content;
    public string $excerpt;
    public array $results;

    private function __construct()
    {
    }

    public static function fromFetch(ArticleEntity $entity): self
    {
        $articleModel = new self();
        $articleModel->title = $entity->title;
        $articleModel->content = $entity->content;
        $articleModel->excerpt = $entity->excerpt;
        return $articleModel;
    }

    public static function fromFetchAll(ArticleEntity $entity): self
    {
        $articleModel = new self();
        $articleModel->title = $entity->title;
        $articleModel->content = $entity->content;
        $articleModel->excerpt = $entity->excerpt;
        return $articleModel;
    }
}
