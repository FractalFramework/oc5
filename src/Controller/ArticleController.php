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
        //$articleModel = $this->articleService->getPost((int) $id);
        $articleModel = $this->articleService->getPostModel((int) $id);
        //$articleModel = $this->articleService->getPostModel2((int) $id);
        //vd($articleModel);
        $res['article'] = $articleModel;
        //pr($res);
        $template_page = $this->prefix . 'post';
        $template = new TemplateController($template_page);
        $template->call($res);
    }

    public function displayPosts(): void
    {
        $datas = $this->articleService->getPosts(20);
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
        $template_page = $this->prefix . 'posts';
        $template = new TemplateController($template_page);
        $template->call($res);
    }

    public function displayLasts(): void
    {
        $datas = $this->articleService->getLasts(10);
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
        $template_page = $this->prefix . 'posts';
        $template = new TemplateController($template_page);
        $template->call($res);
    }

    public function displayCategory(int $cat_id): void
    {
        $datas = $this->articleService->getPostsCategory($cat_id);
        //pr($datas);
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
        $template_page = $this->prefix . 'posts';
        $template = new TemplateController($template_page);
        $template->call($res);
    }

}
