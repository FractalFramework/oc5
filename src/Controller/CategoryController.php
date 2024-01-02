<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\TemplateController;
use App\Service\CategoryService;

class CategoryController extends BaseController
{
    private static $instance;
    private CategoryService $categoryService;

    private function __construct(string $ajaxMode)
    {
        $this->categoryService = CategoryService::getInstance();
        parent::__construct($ajaxMode);
    }

    public static function getInstance(string $target): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($target);
        }
        return self::$instance;
    }

    public function displayCategories(): void
    {
        $categories = $this->categoryService->getCategories();
        $array['results'] = $categories;
        $this->renderHtml($array, 'categories');
    }

}
