<?php

namespace App\Entity;

class ArticleEntity
{
    public int $id;
    public ?int $uid;
    public int $catId;
    public string $title;
    public string $excerpt;
    public ?string $content;
    public string $category;
    public string $date;
    public ?string $dateCreation;
    public int $pub;
    public string $name;

}
