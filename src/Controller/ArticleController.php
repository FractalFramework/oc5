<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ArticleService;
use App\Service\commentService;

class ArticleController extends BaseController
{
    private static $instance;
    private ArticleService $articleService;
    private CommentService $commentService;
    private CategoryController $categoryController;


    private function __construct(string $ajaxMode)
    {
        $this->articleService = ArticleService::getInstance();
        $this->commentService = CommentService::getInstance();
        $this->categoryController = CategoryController::getInstance($ajaxMode);
        parent::__construct($ajaxMode);
    }

    public static function getInstance(string $ajaxMode): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($ajaxMode);
        }
        return self::$instance;
    }

    public function displayPost(string $id): void
    {
        $datas['article'] = $this->articleService->getPost((int) $id);
        $datas['comments'] = $this->commentService->getcomments((int) $id);
        if (!count($datas['comments']))
            $datas['nocomment'] = 'Aucun commentaire';
        $this->renderHtml($datas, 'post');
    }

    public function displayPosts(): void
    {
        $results = $this->articleService->getPosts(20);
        $datas = [];
        foreach ($results as $k => $obj) {
            $datas['results'][] = [
                'id' => $obj->id,
                'title' => $obj->title,
                'excerpt' => $obj->excerpt,
                'category' => $obj->category,
            ];
        }
        //pr($articles);
        $datas['pageTitle'] = 'Tous les articles';
        $this->renderHtml($datas, 'posts');
    }

    public function displayLasts(): void
    {
        $results = $this->articleService->getLasts(10);
        $datas = [];
        foreach ($results as $k => $obj) {
            $datas['results'][] = [
                'id' => $obj->id,
                'title' => $obj->title,
                'excerpt' => $obj->excerpt,
                'category' => $obj->category,
            ];
        }
        $datas['pageTitle'] = 'Derniers articles';
        $this->renderHtml($datas, 'posts');
    }

    public function displayCategory(int $cat_id): void
    {
        $results = $this->articleService->getPostsCategory($cat_id);
        $datas = [];
        foreach ($results as $k => $obj) {
            $datas['results'][] = [
                'id' => $obj->id,
                'title' => $obj->title,
                'excerpt' => $obj->excerpt,
                'category' => $obj->category,
            ];
        }
        $category = $this->categoryController->displayCategory($cat_id); //unuseful
        $datas['category'] = $category;
        $datas['pageTitle'] = 'Articles de ' . $category;
        $this->renderHtml($datas, 'posts');
    }

    public function newPost(): void
    {
        if (!isset($_SESSION['uid']))
            $this->renderHtml([], 'login');
        else {
            $categories = $this->categoryController->getCategories();
            $datas['categories'] = $categories;
            $this->renderHtml($datas, 'formpost');
        }
    }

    public function postSave($requests): void
    {
        $catid = $requests['catid'];
        $title = $requests['title'];
        $excerpt = $requests['excerpt'];
        $content = $requests['content'];

        $error = match (true) {
            !$title => 'N\'oubliez pas le titre quand même',
            !$excerpt => 'Un résumé permet d\'y voir clair',
            !$content => 'Sans contenu, point de salut',
            default => ''
        };

        if ($error) {
            $this->renderHtml(['title' => $title, 'excerpt' => $excerpt, 'content' => $content, 'error' => $error], 'formpost');
            return;
        } else {
            $id = $this->articleService->postSave($catid, $title, $excerpt, $content);
            $this->renderHtml(['id' => $id, 'title' => $title], 'publishedpost');
        }
    }

}
