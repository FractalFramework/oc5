<?php

declare(strict_types=1);

namespace App\Model;

use App\Entity\ContactEntity;

class ContactModel
{
    public int $uid;
    public string $name;
    public string $mail;
    public string $message;
    public string $date;
    public int $pub;
    public array $results;

    private function __construct()
    {
    }

    public static function fromFetch(ContactEntity $entity): self
    {
        $contactModel = new self();
        $contactModel->uid = $entity->uid;
        $contactModel->name = $entity->name;
        $contactModel->mail = $entity->mail;
        $contactModel->message = $entity->message;
        $contactModel->date = $entity->date;
        $contactModel->pub = $entity->pub;
        return $contactModel;
    }

    public static function fromFetchAll(ContactEntity $entity): self
    {
        $contactModel = new self();
        $contactModel->uid = $entity->uid;
        $contactModel->name = $entity->name;
        $contactModel->mail = $entity->mail;
        $contactModel->message = $entity->message;
        $contactModel->date = $entity->date;
        $contactModel->pub = $entity->pub;
        return $contactModel;
    }
}
