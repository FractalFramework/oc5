<?php

namespace App\Entity;

class ArticleEntity
{
    public int $id;
    public int $catId;
    public string $title = '';
    public string $excerpt = '';
    public string $content = '';
    public string $category = '';

    public function getUrl(): string
    {
        return 'post/' . $this->id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getExcerpt(): string
    {
        return $this->excerpt;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getCatid(): int
    {
        return $this->catId;
    }

}
