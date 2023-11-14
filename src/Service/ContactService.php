<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\ContactRepository;
use App\Model\ContactModel;

class ContactService
{
    private static $instance;
    private ContactRepository $contactRepository;

    private function __construct()
    {
        $this->contactRepository = ContactRepository::getInstance();
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getContact(int $id): ContactModel
    {
        $contactEntity = $this->contactRepository->getById($id);
        return ContactModel::fromFetch($contactEntity);
    }

    public function getContacts(int $number): array
    {
        return $contactEntity = $this->contactRepository->getAll($number);
        //ContactModel::fromFetchAll($contactEntity);
    }

    public function contactSave(string $name, string $mail, string $message): string
    {
        return $this->contactRepository->contactSave($name, $mail, $message);
    }

}
