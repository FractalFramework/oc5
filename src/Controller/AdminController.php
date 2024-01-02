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
    private static int $numberElements = 40;

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
            'articles' => $this->articleService->getDashboardPosts(self::$numberElements),
            'comments' => $this->commentService->getDashboardComments(self::$numberElements),
            'contacts' => $this->contactService->getDashboardContacts(self::$numberElements),
            default => $this->articleService->getDashboardPosts(self::$numberElements),
        };
        $array['tab'] = $tab;
        $this->renderHtml($array, 'admin');
    }

    public function reviewArticles(): void
    {
        $array['results'] = $this->articleService->getDashboardPosts(self::$numberElements);
        $array['pageTitle'] = 'Tous les articles';
        $this->renderHtml($array, 'adminArticles');
    }

    public function reviewMyArticles(): void
    {
        $array['results'] = $this->articleService->getDashboardMyPosts(self::$numberElements);
        $array['pageTitle'] = 'Mes articles';
        $this->renderHtml($array, 'adminArticles');
    }

    public function reviewComments(): void
    {
        $array['results'] = $this->commentService->getDashboardComments(self::$numberElements);
        $this->renderHtml($array, 'adminComments');
    }

    public function reviewContacts(): void
    {
        $array['results'] = $this->contactService->getDashboardContacts(self::$numberElements);
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
