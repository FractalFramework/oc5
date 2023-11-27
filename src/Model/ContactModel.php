<?php

declare(strict_types=1);

namespace App\Model;

use App\Entity\ContactEntity;

class ContactModel
{
    public int $id;
    public int $uid;
    public string $name;
    public string $mail;
    public string $msg;
    public ?string $date;
    public int $pub;
    public array $results;

    private function __construct()
    {
    }

    public static function fromFetch(ContactEntity $entity): self
    {
        $contactModel = new self();
        $contactModel->id = $entity->id;
        $contactModel->uid = $entity->uid;
        $contactModel->name = $entity->name;
        $contactModel->mail = $entity->mail;
        $contactModel->msg = $entity->msg;
        $contactModel->date = $entity->date;
        $contactModel->pub = $entity->pub;
        return $contactModel;
    }

    public static function fromFetchAll(array $entities): array
    {
        $contactModel = array_map(
            function ($entity) {
                return self::fromFetch($entity);
            },
            $entities
        );
        return $contactModel;
    }

    public static function forDashboard(array $entities): array
    {
        $articleModels = array_map(
            function ($entity) {
                $contactModel = new self();
                $contactModel->id = $entity->id;
                $contactModel->uid = $entity->uid;
                $contactModel->name = $entity->name;
                $contactModel->mail = $entity->mail;
                $contactModel->msg = $entity->msg;
                $contactModel->date = $entity->date;
                $contactModel->pub = $entity->pub;
                return $contactModel;
            },
            $entities
        );
        return $articleModels;
    }
}
