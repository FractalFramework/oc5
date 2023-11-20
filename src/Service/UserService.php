<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\UserRepository;
use App\Entity\UserEntity;
use App\Model\UserModel;
use App\Model\ErrorModel;

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

    public function getUserFromName(string $name): UserEntity|bool
    {
        return $this->userRepository->findUserFromName($name);
    }

    public function getUserFromUid(int $uid): UserEntity|bool
    {
        return $this->userRepository->findUserFromId($uid);
    }

    public function getUserLoged(string $name, string $pswd): UserModel|ErrorModel
    {
        $userEntity = $this->userRepository->findUserFromName($name);

        if (empty($userEntity->name)) {
            return new ErrorModel(message: 'Utilisateur inconnu');
        }

        $isGoodPassword = password_verify($pswd, $userEntity->pswd ?? '');
        if (!$isGoodPassword) {
            return new ErrorModel(message: 'Mot de passe non reconnu');
        }

        return new UserModel(name: $userEntity->name, uid: $userEntity->id);
    }

    public function registerUser(string $name, string $mail, string $pswd): string
    {
        $pswd = password_hash($pswd, PASSWORD_DEFAULT);
        $values = ['name' => $name, 'mail' => $mail, 'pswd' => $pswd];
        return $this->userRepository->registerUser($values);
    }

    public function getLinks(int $id): array
    {
        return $this->userRepository->userLinks($id);
    }

}
