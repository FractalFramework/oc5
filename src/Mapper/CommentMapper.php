<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Model\CommentModel;
use App\Entity\CommentEntity;

class CommentMapper
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

    public function fromFetch(CommentEntity $entity): CommentModel
    {
        $commentModel = new CommentModel();
        $commentModel->id = $entity->id;
        $commentModel->uid = $entity->uid;
        $commentModel->bid = $entity->bid;
        $commentModel->name = $entity->name;
        $commentModel->txt = $entity->txt;
        $commentModel->mail = $entity->mail;
        $commentModel->surname = $entity->surname;
        $commentModel->date = $entity->date;
        $commentModel->pub = $entity->pub;
        return $commentModel;
    }

    public function fromFetchAll(array $entities): array
    {
        $commentModel = array_map(
            function ($entity) {
                return self::fromFetch($entity);
            },
            $entities
        );
        return $commentModel;
    }

    public function forDashboard(array $entities): array
    {
        $articleModels = array_map(
            function ($entity) {
                $commentModel = new CommentModel();
                $commentModel->id = $entity->id;
                $commentModel->bid = $entity->bid;
                $commentModel->name = $entity->name;
                $commentModel->title = $entity->title;
                $commentModel->txt = $entity->txt;
                $commentModel->mail = $entity->mail;
                $commentModel->date = $entity->date;
                $commentModel->pub = $entity->pub;
                return $commentModel;
            },
            $entities
        );
        return $articleModels;
    }
}
