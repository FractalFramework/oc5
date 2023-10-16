<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\TemplateController;
use App\Service\ArticleService;

class ArticleController
{
    private $prefix = '';
    private static $instance;
    private ArticleService $articleService;
    private CategoryController $categoryController;


    private function __construct(string $target)
    {
        if ($target) {
            $this->prefix = 'alone_';
        }
        $this->articleService = ArticleService::getInstance($target);
        $this->categoryController = CategoryController::getInstance($target);
    }

    public static function getInstance(string $target): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($target);
        }
        return self::$instance;
    }

    public function displayPost(string $id): void
    {
        $article = $this->articleService->getPost((int) $id);
        $template_page = $this->prefix . 'post';
        $template = new TemplateController($template_page);
        $res['results'] = $article; //article //vient de model //pr($res);
        $template->call($res);
    }

    public function displayPosts(): void
    {
        $datas = $this->articleService->getPosts(20);
        $template_page = $this->prefix . 'posts';
        $template = new TemplateController($template_page);
        $articles = [];
        foreach ($datas as $k => $obj) {
            $articles[] = [
                'id' => $obj->id,
                'title' => $obj->title,
                'excerpt' => $obj->excerpt,
                'category' => $obj->category,
            ];
        }
        $res['results'] = $articles;
        //pr($articles);
        $res['pageTitle'] = 'Tous les articles';
        $template->call($res);
    }

    public function displayLasts(): void
    {
        $datas = $this->articleService->getLasts(10);
        $template_page = $this->prefix . 'posts';
        $template = new TemplateController($template_page);
        $res = [];
        foreach ($datas as $k => $obj) {
            $res[] = [
                'id' => $obj->id,
                'title' => $obj->title,
                'excerpt' => $obj->excerpt,
                'category' => $obj->category,
            ];
        }
        $res['results'] = $res;
        $res['pageTitle'] = 'Derniers articles';
        $template->call($res);
    }

    public function displayCategory(int $cat_id): void
    {
        $datas = $this->articleService->getPostsCategory($cat_id);
        //pr($datas);
        $template_page = $this->prefix . 'posts';
        $template = new TemplateController($template_page);
        $res = [];
        foreach ($datas as $k => $obj) {
            $res[] = [
                'id' => $obj->id,
                'title' => $obj->title,
                'excerpt' => $obj->excerpt,
                'category' => $obj->category,
            ];
        }
        $res['results'] = $res;
        $category = $this->categoryController->displayCategory($cat_id); //unuseful
        $res['category'] = $category;
        $res['pageTitle'] = 'Articles de ' . $category;
        $template->call($res);
    }

}
