<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\articleRepository;
use App\Entity\ArticleEntity;
use App\Model\ArticleModel;

class ArticleService
{
    private static $instance;
    private ArticleRepository $articleRepository;
    private ArticleModel $articleModel;

    private function __construct()
    {
        $this->articleRepository = ArticleRepository::getInstance();
        $this->articleModel = ArticleModel::getInstance();
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
        //todo: transformer articleEntity en un articleModel
        $articleEntity = $this->articleRepository->getById($id);
        return $this->articleModel->specifyDatas($articleEntity);
    }

    public function getPosts(int $number): array
    {
        return $this->articleRepository->getAll($number);
    }

    public function getLasts(int $number): array
    {
        return $this->articleRepository->getLasts($number);
    }

    public function getPostsCategory(int $id): array
    {
        return $this->articleRepository->getByCategory($id);
    }

}
