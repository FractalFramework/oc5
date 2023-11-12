<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\UserEntity;
use App\Service\DbService;

class UserRepository
{
    protected static string $table = 'users';
    protected static string $socials = 'socials';
    private static $instance;
    private DbService $dbService;

    private function __construct()
    {
        $this->dbService = DbService::getInstance();
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function userInfos(int $id): UserEntity
    {
        $sql = 'select users.id,name,mail,surname,slogan,banner,logo
        from users
        left join profile
        on users.id=uid
        where users.id=?';
        return $this->dbService->fetchUser($sql, [$id]);
    }

    public function findUserFromId(int $id): UserEntity
    {
        $sql = 'select name from ' . self::$table . ' where id=?';
        return $this->dbService->fetchUser($sql, [$id]);
    }

    public function findUserFromName(string $name): UserEntity|bool
    {
        $sql = 'select id,name,pswd from ' . self::$table . ' where name=?';
        return $this->dbService->fetchUser($sql, [$name]);
    }

    public function registerUser(array $blind): string
    {
        $sql = 'insert into ' . self::$table . ' values (null, :name, 1, :mail, :pswd, now())';
        return $this->dbService->fetchAddUser($sql, $blind);
    }

    public function userLinks(int $id): array
    {
        $sql = 'select url from socials where uid=?';
        return $this->dbService->fetchAllSocials($sql, [$id]);
    }

}
