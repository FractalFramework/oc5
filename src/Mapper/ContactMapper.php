<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Model\ContactModel;
use App\Entity\ContactEntity;

class ContactMapper
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

    public function fromFetch(ContactEntity $entity): ContactModel
    {
        $contactModel = new ContactModel();
        $contactModel->id = $entity->id;
        $contactModel->uid = $entity->uid;
        $contactModel->name = $entity->name;
        $contactModel->mail = $entity->mail;
        $contactModel->msg = $entity->msg;
        $contactModel->date = $entity->date;
        $contactModel->pub = $entity->pub;
        return $contactModel;
    }

    public function fromFetchAll(array $entities): array
    {
        $contactModel = array_map(
            function ($entity) {
                return self::fromFetch($entity);
            },
            $entities
        );
        return $contactModel;
    }

    public function forDashboard(array $entities): array
    {
        $articleModels = array_map(
            function ($entity) {
                $contactModel = new ContactModel();
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
