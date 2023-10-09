<?php

namespace App;

use App\Controllers\ArticleController;
use App\Controllers\CategoryController;
use App\Controllers\TemplateController;

class Rooter
{
    public function __construct()
    {
        //boot

    }

    public function test(array $params): void
    {
        $datas['pageTitle'] = 'hey';
        $datas['page'] = 'test'; //current state
        $datas['results'] =
            [
                0 => [
                    'title' => 'one',
                    'excerpt' => 'un'
                ],
                1 => [
                    'title' => 'two',
                    'excerpt' => 'deux'
                ],
            ];
        $target = get('_tg');
        $template_page = ($target ? 'alone_' : '') . 'posts';
        $template = new TemplateController($template_page);
        $template->call($datas);
    }

    public function index(array $params): mixed
    {
        //pr($params);
        $com = $params['com'] ?? 'test'; //default
        $id = $params['p1'] ?? 1; //interessant
        $target = get('_tg');
        $article = new ArticleController($target);
        $category = new CategoryController($target);
        return match ($com) {
            'test' => $this->test($params),
            'home' => $article->post(1),
            'post' => $article->post((int) $id),
            'posts' => $article->posts($id),
            'category' => $article->category($id),
            'categories' => $category->allCategories(),
            default => $article->post(1)
        };


    }

}
