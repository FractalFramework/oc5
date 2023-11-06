<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\articleRepository;
use App\Entity\ArticleEntity;
use App\Model\ArticleModel;
use App\Model\ArticleModel2;

class ArticleService
{
    private static $instance;
    private ArticleRepository $articleRepository;
    private ArticleModel $articleModel;

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

    public function getPost(int $id): ArticleModel
    {
        $articleEntity = $this->articleRepository->getById($id);
        return ArticleModel::fromFetch($articleEntity);
    }

    public function getPosts(int $number): array
    {
        return $articleEntity = $this->articleRepository->getAll($number);
        //ArticleModel::fromFetchAll($articleEntity);
    }

    public function getLasts(int $number): array
    {
        return $this->articleRepository->getLasts($number);
    }

    public function getPostsCategory(int $id): array
    {
        return $this->articleRepository->getByCategory($id);
    }

    public function postSave(string $catid, string $title, string $excerpt, string $content): string
    {
        $values = [
            'uid' => $_SESSION['uid'],
            'catid' => $catid,
            'title' => $title,
            'excerpt' => $excerpt,
            'content' => $content,
            'pub' => 0
        ];
        return $this->articleRepository->postSave($values);
    }

}
