<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\ContactRepository;
use App\Model\ContactModel;
use App\Mapper\ContactMapper;

class ContactService
{
    private static $instance;
    private ContactRepository $contactRepository;
    private ContactMapper $contactMapper;

    private function __construct()
    {
        $this->contactRepository = ContactRepository::getInstance();
        $this->contactMapper = ContactMapper::getInstance();
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
        return $this->contactMapper->fromFetch($contactEntity);
    }

    public function getContacts(int $number): array
    {
        return $$this->contactRepository->getAll($number);
    }

    public function getDashboardContacts(int $number): array
    {
        $contactEntities = $this->contactRepository->getAll($number);
        return $this->contactMapper->forDashboard($contactEntities);
    }

    public function sendmail($message): void
    {
        mail(
            'agence2dav@gmail.com',
            'contact from oc5',
            $message,
            [], //additional_headers
            "" //additional_params
        );
    }

    public function contactSave(string $name, string $mail, string $message): string
    {
        $this->sendmail($message);
        return $this->contactRepository->contactSave($name, $mail, $message);
    }

    public function contactPub(int $id, int $publish): void
    {
        $this->contactRepository->contactPub($id, $publish);
    }

}
