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
        $datas['postId'] = $id;
        $datas['article'] = $this->articleService->getPost((int) $id);
        $datas['comments'] = $this->commentService->getcomments((int) $id);
        $datas['editable'] = $datas['article']->uid == $_SESSION['uid'] ? 1 : 0;
        if (!$datas['article']->pub)
            $this->renderHtml($datas, 'nopost');
        else
            $this->renderHtml($datas, 'post');
    }

    public function displayPosts(): void
    {
        $results = $this->articleService->getPosts(20);
        $datas['pageTitle'] = 'Tous les articles';
        $datas['results'] = $results;
        $this->renderHtml($datas, 'posts');
    }

    public function displayLasts(): void
    {
        $results = $this->articleService->getLasts(10);
        $datas['pageTitle'] = 'Derniers articles';
        $datas['results'] = $results;
        $this->renderHtml($datas, 'posts');
    }

    public function displayCategory(int $cat_id): void
    {
        $potCategories = $this->articleService->getPostsCategory($cat_id);
        $category = $this->categoryController->displayCategory($cat_id); //unuseful
        $datas['category'] = $category;
        $datas['pageTitle'] = $category;
        $datas['results'] = $potCategories;
        $this->renderHtml($datas, 'posts');
    }

    public function newPost(): void
    {
        if (!isset($_SESSION['uid']))
            $this->renderHtml([], 'login');
        else {
            $datas['categories'] = $this->categoryController->getCategories();
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
        }
        $postId = $this->articleService->postSave($catid, $title, $excerpt, $content);
        $this->renderHtml(['id' => $postId, 'title' => $title], 'publishedpost');
    }

    public function postEdit($requests): void
    {
        $postId = $requests['postId'];
        $datas['postId'] = $postId;
        $datas['article'] = $this->articleService->getPost((int) $postId);
        $datas['editable'] = $datas['article']->uid == $_SESSION['uid'] ? 1 : 0;
        $datas['modif'] = 1;
        if ($datas['editable']) {
            $datas['categories'] = $this->categoryController->getCategories();
            $this->renderHtml($datas, 'formpost');
        } else { //show post
            $datas['comments'] = $this->commentService->getcomments((int) $postId);
            $this->renderHtml($datas, 'post');
        }
    }

    public function postUpdate($requests): void
    {
        $postId = $requests['postId'];
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
        }
        $id = $this->articleService->postUpdate((int) $postId, $catid, $title, $excerpt, $content);
        $this->renderHtml(['id' => $postId, 'title' => $title], 'publishedpost');
    }

}
