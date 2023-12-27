<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ArticleService;
use App\Service\CommentService;
use App\Service\CategoryService;
use App\Controller\CategoryController;

class ArticleController extends BaseController
{
    private static $instance;
    private ArticleService $articleService;
    private CommentService $commentService;
    private CategoryService $categoryService;
    private CategoryController $CategoryController;

    private function __construct(string $ajaxMode)
    {
        $this->articleService = ArticleService::getInstance();
        $this->commentService = CommentService::getInstance();
        $this->categoryService = CategoryService::getInstance();
        $this->CategoryController = CategoryController::getInstance($ajaxMode);
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
        $datas['editable'] = $datas['article']->uid == sesint('uid') ? true : false;
        $datas['justPosted'] = 0;

        $isPublic = $datas['article']->pub ? true : false;
        if ($isPublic == true || ($isPublic == false && sesint('uid') == $datas['article']->uid))
            $this->renderHtml($datas, 'post');
        else
            $this->renderHtml($datas, 'nopost');
    }

    public function displayPosts(): void
    {
        $datas['results'] = $this->articleService->getPosts(100);
        $datas['pageTitle'] = 'Articles';
        $datas['owner'] = sesint('uid');
        $this->renderHtml($datas, 'posts');
    }

    public function displayCategory(int $cat_id): void
    {
        $datas['results'] = $this->articleService->getPostsCategory($cat_id);
        $datas['category'] = $this->categoryService->getCategory($cat_id)->category;
        $this->renderHtml($datas, 'posts');
    }

    public function newPost(): void
    {
        if (!sesint('uid'))
            $this->renderHtml([], 'login');
        else {
            $datas['categories'] = $this->categoryService->getCategories(); //to generalize
            $this->renderHtml($datas, 'formpost');
        }
    }

    public function postSave(array $requests): void
    {
        $title = $requests['title'];
        $category = $requests['category'];
        $excerpt = $requests['excerpt'];
        $content = $requests['content'];
        $categories = $this->categoryService->getCategories();

        $error = match (true) {
            !$title => 'N\'oubliez pas le titre quand même',
            !$category => 'Choisissez ou créez une catégorie',
            !$excerpt => 'Un résumé permet d\'y voir clair',
            !$content => 'Sans contenu, point de salut',
            default => ''
        };

        if ($error) {
            $this->renderHtml(
                [
                    'article' => [
                        'title' => $title,
                        'category' => $category,
                        'excerpt' => $excerpt,
                        'content' => $content
                    ],
                    'categories' => $categories,
                    'error' => $error
                ],
                'formpost'
            );
            return;
        }
        echo $category;
        $catid = $this->categoryService->getCategoryId($category);
        echo '-' . $catid . '-';
        if (!$catid) {
            $catid = $this->categoryService->CreateCategory($category);
        }
        echo $catid;
        if ($catid) {
            $postId = $this->articleService->postSave($catid, $title, $excerpt, $content);
            //$this->renderHtml(['id' => $postId, 'title' => $title, 'categories' => $categories], 'post');
            $this->displayPost($postId);
        }
    }

    public function postEdit(int $postId): void
    {
        $datas = [];
        $datas['postId'] = $postId;
        $datas['article'] = $this->articleService->getPost($postId);
        $datas['editable'] = $datas['article']->uid == sesint('uid') ? true : false;
        $datas['modif'] = true;
        if ($datas['editable']) {
            $datas['categories'] = $this->categoryService->getCategories();
            $this->renderHtml($datas, 'formpost');
        } else {
            //show post
            $datas['comments'] = $this->commentService->getcomments($postId);
            $this->renderHtml($datas, 'post');
        }
    }

    public function postUpdate(array $requests): void
    {
        $postId = $requests['postId'];
        $title = $requests['title'];
        $category = $requests['category'];
        $excerpt = $requests['excerpt'];
        $content = $requests['content'];
        $categories = $this->categoryService->getCategories();

        $error = match (true) {
            !$title => 'N\'oubliez pas le titre quand même',
            !$excerpt => 'Un résumé permet d\'y voir clair',
            !$content => 'Sans contenu, point de salut',
            default => ''
        };
        if ($error) {
            $this->renderHtml(
                [
                    'editable' => true,
                    'modif' => true,
                    'article' => [
                        'title' => $title,
                        'category' => $category,
                        'excerpt' => $excerpt,
                        'content' => $content
                    ],
                    'categories' => $categories,
                    'error' => $error
                ], 'formpost');
            return;
        }

        $catid = $this->categoryService->getCategoryId($category);
        if (!$catid) {
            $catid = $this->categoryService->CreateCategory($category);
        }
        if ($catid) {
            $this->articleService->postUpdate((int) $postId, $catid, $title, $excerpt, $content);
        }
        //$this->renderHtml(['id' => $postId, 'title' => $title], 'publishedpost');
        $this->displayPost($postId);
    }

}
