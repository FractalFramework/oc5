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
        $datas['editable'] = $datas['article']->uid == ($_SESSION['uid'] ?? 0);
        $uid = $_SESSION['uid'] ?? 0;

        $isPublic = $datas['article']->pub ?? 0;
        if ($isPublic || (!$isPublic && $uid)) //==1 superadmin
            $this->renderHtml($datas, 'post');
        else
            $this->renderHtml($datas, 'nopost');
    }

    public function displayPosts(): void
    {
        $datas['results'] = $this->articleService->getPosts(20);
        $datas['pageTitle'] = 'Articles';
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
        if (!isset($_SESSION['uid']))
            $this->renderHtml([], 'login');
        else {
            $datas['categories'] = $this->categoryService->getCategories(); //to generalize
            $this->renderHtml($datas, 'formpost');
        }
    }

    public function postSave(array $requests): void
    {
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
            $this->renderHtml(
                [
                    'title' => $title,
                    'excerpt' => $excerpt,
                    'content' => $content,
                    'error' => $error
                ],
                'formpost'
            );
            return;
        }
        $postId = $this->articleService->postSave($requests['catid'], $title, $excerpt, $content);
        $this->renderHtml(['id' => $postId, 'title' => $title], 'publishedpost');
        //$this->displayPost($postId);
    }

    public function postEdit(int $postId): void
    {
        $datas['postId'] = $postId;
        $datas['article'] = $this->articleService->getPost($postId);
        $datas['editable'] = $datas['article']->uid == $_SESSION['uid'] ? 1 : 0;
        $datas['modif'] = true;
        if ($datas['editable']) {
            $datas['categories'] = $this->categoryService->getCategories();
            $this->renderHtml($datas, 'formpost');
        } else { //show post
            $datas['comments'] = $this->commentService->getcomments($postId);
            $this->renderHtml($datas, 'post');
        }
    }

    public function postUpdate(array $requests): void
    {
        $postId = $requests['postId'];
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
            $this->renderHtml([
                'editable' => true,
                //cheat
                'modif' => true,
                'article' => [
                    'title' => $title,
                    'excerpt' => $excerpt,
                    'content' => $content
                ],
                'error' => $error
            ], 'formpost');
            return;
        }
        $ok = $this->articleService->postUpdate((int) $postId, $requests['catid'], $title, $excerpt, $content);
        $this->renderHtml(['id' => $postId, 'title' => $title], 'publishedpost');
        //$this->displayPost($postId);
    }

}
