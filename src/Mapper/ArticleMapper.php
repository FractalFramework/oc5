<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Model\ArticleModel;
use App\Entity\ArticleEntity;

class ArticleMapper
{
    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function fromFetch(ArticleEntity $entity): ArticleModel|bool
    {
        $articleModel = new ArticleModel();
        $articleModel->id = $entity->id;
        $articleModel->uid = $entity->uid ?? null;
        $articleModel->title = $entity->title;
        $articleModel->content = $entity->content ?? '';
        $articleModel->excerpt = $entity->excerpt;
        $articleModel->category = $entity->category;
        $articleModel->name = $entity->name;
        $articleModel->date = $entity->date;
        $articleModel->pub = $entity->pub;
        return $articleModel;
    }

    public static function fromFetchAll(array $entities): array
    {
        $articleModels = array_map(
            function ($entity) {
                return self::fromFetch($entity);
            },
            $entities
        );
        return $articleModels;
    }

    public function forDashboard(array $entities): array|bool
    {
        $articleModels = array_map(
            function ($entity) {
                $articleModel = new ArticleModel;
                $articleModel->id = $entity->id;
                $articleModel->title = $entity->title;
                $articleModel->excerpt = $entity->excerpt;
                $articleModel->name = $entity->name;
                $articleModel->date = $entity->date;
                $articleModel->date = $entity->dateCreation;
                $articleModel->pub = $entity->pub;
                return $articleModel;
            },
            $entities
        );
        return $articleModels;
    }
}
