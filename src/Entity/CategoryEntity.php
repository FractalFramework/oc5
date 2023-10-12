<?php

namespace App\Entity;

class CategoryEntity
{
    public int $id = 0;
    public string $category = '';

    public function getUrl(): string
    {
        return 'category/' . $this->id;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getId(): string
    {
        return $this->id;
    }

}
