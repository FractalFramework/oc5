<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\UserEntity;
use App\Model\Connect;
use PDO;

class UserRepository
{
    protected static string $table = 'users';
    protected static string $socials = 'socials';
    private static $instance;
    private Connect $connect;

    private function __construct()
    {
        $this->connect = Connect::getInstance();
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    # fetches

    private function fetchUser(string $sql, array $blind): UserEntity|bool
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, UserEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetch();
    }

    private function fetchAddUser(string $sql, array $blind): string
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, UserEntity::class, null);
        //$stmt->bindParam(':name', $name, PDO::PARAM_STR);
        //$stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        //$stmt->bindParam(':pswd', $pswd, PDO::PARAM_STR);
        $stmt->execute($blind);
        return $pdo->lastInsertId();
    }

    private function fetchAllSocials(string $sql, array $blind): array
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, UserEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetchAll();
    }

    # sql

    public function userInfos(int $id): UserEntity
    {
        $sql = 'select users.id,name,mail,surname,slogan,banner,logo
        from users
        left join profile
        on users.id=uid
        where users.id=?';
        return $this->fetchUser($sql, [$id]);
    }

    public function findUserFromId(int $id): UserEntity
    {
        $sql = 'select name,mail from ' . self::$table . ' where id=?';
        return $this->fetchUser($sql, [$id]);
    }

    public function findUserFromName(string $name): UserEntity|bool
    {
        $sql = 'select id,name,pswd from ' . self::$table . ' where name=?';
        return $this->fetchUser($sql, [$name]);
    }

    public function registerUser(array $blind): string
    {
        $sql = 'insert into ' . self::$table . ' values (null, :name, 1, :mail, :pswd, now())';
        return $this->fetchAddUser($sql, $blind);
    }

    public function userLinks(int $id): array
    {
        $sql = 'select url from socials where uid=?';
        return $this->fetchAllSocials($sql, [$id]);
    }

}
