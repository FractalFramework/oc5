<?php

declare(strict_types=1);

namespace App\Model;

use App\Entity\CommentEntity;

class CommentModel
{
    public int $id;
    public int $uid;
    public int $bid;
    public string $name;
    public string $mail;
    public ?string $surname;
    public ?string $title;
    public string $txt;
    public string $date;
    public int $pub;

    private function __construct()
    {
    }

    public static function fromFetch(CommentEntity $entity): self
    {
        $commentModel = new self();
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

    public static function fromFetchAll(array $entities): array
    {
        $commentModel = array_map(
            function ($entity) {
                return self::fromFetch($entity);
            },
            $entities
        );
        return $commentModel;
    }

    public static function forDashboard(array $entities): array
    {
        $articleModels = array_map(
            function ($entity) {
                $commentModel = new self();
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
