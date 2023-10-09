<?php

namespace App\Entities;

class CategoryEntity
{
    public string $category = '';
    public int $id = 0;

    public function getUrl(): string
    {
        return 'category/' . $this->id;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

}
