<?php

declare(strict_types=1);

namespace App\Controller;

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
        $tab = $requests['p2'] ?? 'articles';
        if (!$tab)
            $tab = 'articles';
        $array['result'] = match ($tab) {
            'articles' => $this->articleService->getDashboardPosts(20),
            'comments' => $this->commentService->getDashboardComments(40),
            'contacts' => $this->contactService->getDashboardContacts(40),
            default => $this->articleService->getDashboardPosts(20),
        };
        $array['tab'] = $tab;
        $this->renderHtml($array, 'admin');
    }

    public function reviewArticles(): void
    {
        $array['results'] = $this->articleService->getDashboardPosts(20);
        $this->renderHtml($array, 'adminArticles');
    }

    public function reviewComments(): void
    {
        $array['results'] = $this->commentService->getDashboardComments(40);
        $this->renderHtml($array, 'adminComments');
    }

    public function reviewContacts(): void
    {
        $array['results'] = $this->contactService->getDashboardContacts(40);
        $this->renderHtml($array, 'adminContacts');
    }

    public function articlePub(array $requests): void
    {
        $this->articleService->articlePub((int) $requests['id'], (int) $requests['publish']);
        $this->reviewArticles();
    }

    public function commentPub(array $requests): void
    {
        $this->commentService->commentPub((int) $requests['id'], (int) $requests['publish']);
        $this->reviewComments();
    }

    public function contactPub(array $requests): void
    {
        $this->contactService->contactPub((int) $requests['id'], (int) $requests['publish']);
        $this->reviewContacts();
    }

}
