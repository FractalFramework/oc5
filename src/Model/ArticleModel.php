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

    public static function fromDatabase(ArticleEntity $entity): self
    {
        $articleModel = new self();
        $articleModel->title = $entity->title;
        $articleModel->content = $entity->content;
        $articleModel->excerpt = $entity->excerpt;
        $articleModel->results = [ //unused
            'title' => $entity->title,
            'content' => $entity->content,
            'excerpt' => $entity->excerpt
        ];
        return $articleModel;
    }
}
