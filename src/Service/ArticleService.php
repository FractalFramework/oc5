<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\articleRepository;
use App\Model\ArticleModel;
use App\Mapper\ArticleMapper;

class ArticleService
{
    private static $instance;
    private ArticleRepository $articleRepository;
    private ArticleMapper $articleMapper;

    private function __construct()
    {
        $this->articleRepository = ArticleRepository::getInstance();
        $this->articleMapper = ArticleMapper::getInstance();
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPost(int $id): ArticleModel
    {
        $articleEntity = $this->articleRepository->getById($id);
        return $this->articleMapper->fromFetch($articleEntity);
    }

    public function getPosts(int $number): array
    {
        return $this->articleRepository->getAll($number);
    }

    public function getDashboardPosts(int $number): array
    {
        $articleEntities = $this->articleRepository->getAllAdmin($number);
        return $this->articleMapper->forDashboard($articleEntities);
    }

    public function getDashboardMyPosts(int $number): array
    {
        $articleEntities = $this->articleRepository->getMyAll($number);
        return $this->articleMapper->forDashboard($articleEntities);
    }

    public function getPostsCategory(int $id): array
    {
        return $this->articleRepository->getByCategory($id);
    }

    public function postSave(int $catid, string $title, string $excerpt, string $content): string
    {
        return $this->articleRepository->postSave($catid, $title, $excerpt, $content);
    }

    public function postUpdate(int $postId, int $catid, string $title, string $excerpt, string $content): bool
    {
        return $this->articleRepository->postUpdate($postId, $catid, $title, $excerpt, $content);
    }

    public function articlePub(int $id, int $publish): void
    {
        $this->articleRepository->articlePub($id, $publish);
    }

}
