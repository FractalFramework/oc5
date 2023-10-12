<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\articleRepository;
use App\Entity\ArticleEntity;

class ArticleService
{
    private static $instance;
    private ArticleRepository $articleRepository;

    private function __construct()
    {
        $this->articleRepository = ArticleRepository::getInstance();
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPost(int $id): ArticleEntity //ArticleModel
    {
        return $this->articleRepository->getById($id);
        //todo: transformer articleEntity en un articleModel
    }

    public function getPosts(int $number): array //ArticleModel
    {
        return $this->articleRepository->getAll($number);
        //todo: transformer articleEntity en un articleModel
    }

    public function getLasts(int $number): array //ArticleModel
    {
        return $this->articleRepository->getLasts($number);
        //todo: transformer articleEntity en un articleModel
    }

    public function getPostsCategory(int $id): array //ArticleModel
    {
        return $this->articleRepository->getByCategory($id);
        //todo: transformer articleEntity en un articleModel
    }

}
