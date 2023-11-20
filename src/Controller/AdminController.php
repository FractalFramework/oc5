<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\AdminModel;
use App\Service\ArticleService;
use App\Service\CommentService;
use App\Service\ContactService;

class AdminController extends BaseController
{
    private static $instance;
    private ArticleService $articleService;
    private CommentService $commentService;
    private ContactService $contactService;

    private function __construct(string $ajaxMode)
    {
        $this->articleService = ArticleService::getInstance();
        $this->commentService = CommentService::getInstance();
        $this->contactService = ContactService::getInstance();
        parent::__construct($ajaxMode);
    }

    public static function getInstance(string $target): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($target);
        }
        return self::$instance;
    }

    public function dashboard(array $requests): void
    {
        $array['result'] = $this->articleService->getPosts(20);
        $this->renderHtml($array, 'admin');
    }

    public function reviewArticles(): void
    {
        $articleEntity = $this->articleService->getPosts(20);
        $array['results'] = AdminModel::fetchArticles($articleEntity);
        $this->renderHtml($array, 'admin');
    }

    public function reviewComments(): void
    {
        $commentEntity = $this->commentService->getAllComments(40);
        $array['results'] = AdminModel::fetchComments($commentEntity);
        $this->renderHtml($array, 'admin');
    }

    public function reviewContacts(): void
    {
        $contactEntity = $this->contactService->getContacts(40);
        $array['results'] = AdminModel::fetchContacts($contactEntity);
        $this->renderHtml($array, 'admin');
    }

}
