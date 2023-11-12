<?php

namespace App\Entity;

class ArticleEntity
{
    public int $id;
    public int $uid;
    public int $catId;
    public string $title;
    public string $excerpt;
    public string $content;
    public string $category;
    public string $date;
    public int $pub;
    public string $name;

    public function getUrl(): string
    {
        return '/post/' . $this->id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUid(): int
    {
        return $this->uid;
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

    public function getDate(): string
    {
        return $this->date;
    }

    public function getPub(): int
    {
        return $this->pub;
    }

    public function getName(): string
    {
        return $this->name;
    }

}
