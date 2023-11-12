<?php

declare(strict_types=1);

namespace App\Model;

use App\Entity\CommentEntity;

class CommentModel
{
    public ?int $id;
    public ?int $uid;
    public ?int $bid;
    public ?string $name;
    public ?string $mail;
    public ?string $auth;
    public ?string $surname;
    public ?string $txt;
    public ?string $date;
    public ?int $pub;

    private function __construct()
    {
    }

    public static function fromFetch(CommentEntity $entity): self
    {
        $commentModel = new self();
        $commentModel->uid = $entity->uid;
        $commentModel->name = $entity->name;
        $commentModel->txt = $entity->txt;
        $commentModel->mail = $entity->mail;
        $commentModel->auth = $entity->auth;
        $commentModel->surname = $entity->surname;
        $commentModel->date = $entity->date;
        $commentModel->pub = $entity->pub;
        return $commentModel;
    }

    public static function fromFetchAll(array $entities): self
    { //draft
        $commentModel = new self();
        foreach ($entities as $entity) {
            $commentModel = self::fromFetch($entity);
        }
        return $commentModel;
    }
}
