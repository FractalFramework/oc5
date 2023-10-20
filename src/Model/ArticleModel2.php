<?php

declare(strict_types=1);

namespace App\Model;

use App\Entity\ArticleEntity;

class ArticleModel2
{
    public string $title;
    public string $content;
    public string $excerpt;
    public array $results;

    function __construct()
    {
    }

    public function fromDatabase(ArticleEntity $entity): self
    {
        $this->title = $entity->title;
        $this->content = $entity->content;
        $this->excerpt = $entity->excerpt;
        $this->results = [
            'title' => $entity->title,
            'content' => $entity->content,
            'excerpt' => $entity->excerpt
        ];
        return new self();
    }
}
