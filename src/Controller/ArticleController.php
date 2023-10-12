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
        $this->articleService = ArticleService::getInstance();
        $this->categoryController = CategoryController::getInstance('1');
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
        $article = $this->articleService->getPost((int) $id); //vd($datas);
        $template_page = $this->prefix . 'post';
        $template = new TemplateController($template_page);
        $array['results'] = $article; //article //vient de model //pr($array);
        $template->call($array);
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
                'title' => $obj->category,
                'excerpt' => $obj->excerpt,
                'category' => $obj->category,
            ];
        }
        $array['results'] = $articles;
        //pr($articles);
        $array['pageTitle'] = 'Tous les articles';
        $template->call($array);
    }

    public function displayLasts(): void
    {
        $datas = $this->articleService->getLasts(10);
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
        $array['pageTitle'] = 'Derniers articles';
        $template->call($array);
    }

    public function displayCategory(int $cat_id): void
    {
        $datas = $this->articleService->getPostsCategory($cat_id);
        //pr($datas);
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
        $category = $this->categoryController->displayCategory($cat_id); //unuseful
        $array['category'] = $category;
        $array['pageTitle'] = 'Articles de ' . $category;
        $template->call($array);
    }

}
