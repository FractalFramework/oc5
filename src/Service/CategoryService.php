<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\categoryRepository;
use App\Entity\CategoryEntity;

class CategoryService
{
    private static $instance;
    private CategoryRepository $categoryRepository;

    private function __construct()
    {
        $this->categoryRepository = CategoryRepository::getInstance();
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getCategory(int $id): CategoryEntity
    {
        return $this->categoryRepository->findCategoryFromId($id);
    }

    public function getCategories(): array
    {
        return $this->categoryRepository->allCategories();
    }

    public function getCategoriesArray(): array
    {
        $result = $this->categoryRepository->allCategories();
        $categories = [];
        foreach ($result as $category) {
            $categories[$category->id] = $category->value;
        }

        /*$categories = array_map(
            function ($category) {
                return [$category->id => $category->value];
            }
            ,
            $result
        );*/
        return $categories;
    }

}
