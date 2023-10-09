<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\CategoryService;
use App\Controllers\TemplateController;

class CategoryController extends CategoryService
{
    private $prefix = '';

    public function __construct($target)
    {
        if ($target) {
            $this->prefix = 'alone_';
        }
    }

    public function all(int $id = 1): void
    {
        $datas = $this->allCategories();
        $template_page = $this->prefix . 'categories';
        $template = new TemplateController($template_page);
        $array = [];
        foreach ($datas as $k => $obj) {
            $array[] = [
                'cat_id' => $obj->id,
                'category' => $obj->category,
            ];
        }
        $array['results'] = $array;
        $template->call($array);
    }

    public function find(int $cat_id = 1): string
    {
        $datas = $this->findCategoryFromId($cat_id);
        return $datas->category;
    }

}
