<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\TemplateController;
use App\Service\ArticleService;
use App\Service\CommentsService;

class ArticleController
{
    private $prefix = '';
    private static $instance;
    private ArticleService $articleService;
    private CommentsService $commentsService;
    private CategoryController $categoryController;


    private function __construct(string $prefix)
    {
        $this->prefix = $prefix;
        $this->articleService = ArticleService::getInstance();
        $this->commentsService = CommentsService::getInstance();
        $this->categoryController = CategoryController::getInstance($prefix);
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
        $res['article'] = $this->articleService->getPost((int) $id);
        $res['comments'] = $this->commentsService->getComments((int) $id);
        if (!count($res['comments']))
            $res['nocomment'] = 'Aucun commentaire';
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
