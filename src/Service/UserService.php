<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\userRepository;
use App\Entity\UserEntity;

class UserService
{
    private static $instance;
    private UserRepository $userRepository;

    private function __construct()
    {
        $this->userRepository = UserRepository::getInstance();
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getUserName(int $id): UserEntity
    {
        return $this->userRepository->findUserFromId($id);
    }

    public function getUser(int $id): UserEntity
    {
        return $this->userRepository->userInfos($id);
    }

    public function getLinks(int $id): array
    {
        return $this->userRepository->userLinks($id);
    }

}
