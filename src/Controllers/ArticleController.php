<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\ArticleService;
use App\Controllers\TemplateController;

class ArticleController extends ArticleService
{
    private $prefix = '';

    public function __construct($target)
    {
        if ($target) {
            $this->prefix = 'alone_';
        }
    }

    public function post(int $id): void
    {
        $datas = $this->articleById($id);
        //vd($datas);
        $template_page = $this->prefix . 'post';
        $template = new TemplateController($template_page);
        $array['results'] = [
            'id' => $datas->id,
            'title' => $datas->title,
            'content' => $datas->content,
        ];
        //pr($array);
        $template->call($array);
    }

    public function posts(): void
    {
        $datas = $this->allArticles();
        $template_page = $this->prefix . 'posts';
        $template = new TemplateController($template_page);
        $array = [];
        foreach ($datas as $k => $obj) {
            $array[] = [
                'id' => $obj->id,
                'title' => $obj->category,
                'excerpt' => $obj->excerpt,
                'category' => $obj->category,
            ];
        }
        $array['results'] = $array;
        $template->call($array);
    }

    public function lasts(): void
    {
        $datas = $this->lastsArticles();
        $template_page = $this->prefix . 'post';
        $template = new TemplateController($template_page);
        $array = [];
        foreach ($datas as $k => $obj) {
            $array[] = [
                'id' => $obj->id,
                'title' => $obj->category,
                'excerpt' => $obj->excerpt,
                'category' => $obj->category,
            ];
        }
        $array['results'] = $array;
        $template->call($array);
    }

    public function category(int $cat_id): void
    {
        $datas = $this->ArticlesByCategory($cat_id);
        pr($datas);
        $template_page = $this->prefix . 'posts';
        $template = new TemplateController($template_page);
        $array = [];
        foreach ($datas as $k => $obj) {
            $array[] = [
                'id' => $obj->id,
                'title' => $obj->category,
                'excerpt' => $obj->excerpt,
                'category' => $obj->category,
            ];
        }
        $array['results'] = $array;
        $template->call($array);
    }

}
