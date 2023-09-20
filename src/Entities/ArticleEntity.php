<?php

namespace App\Entities;

class ArticleEntity
{

    public int $id = 0;
    public string $title = '';
    public string $content = '';
    public string $category = '';

    public function getUrl(): string
    {
        return '/' . $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

}
