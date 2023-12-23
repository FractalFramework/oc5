<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\UserRepository;
use App\Model\HomeModel;
use App\Entity\UserEntity;

class HomeService
{
    private static $instance;
    private UserRepository $userRepository;

    private function __construct()
    {
        $this->userRepository = userRepository::getInstance();
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getHome(int $id): UserEntity //HomeModel
    {
        return $this->userRepository->userInfos($id);
    }

}
