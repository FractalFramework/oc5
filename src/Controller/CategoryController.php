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
        $categories = $this->categoryService->getCategories(); //vd($datas);
        /*$datas = [];
        foreach ($categories as $k => $obj) {
            $datas[] = [
                'id' => $obj->id,
                'url' => $obj->url,
                'category' => $obj->category,
            ];
        }*/
        $array['results'] = $categories;
        $this->renderHtml($array, 'categories');
    }

    public function displayCategory(int $cat_id): string
    {
        $category = $this->categoryService->getCategory($cat_id); //vd($datas);
        return $category->category;
    }

}
