<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\MainPdo;
use App\Entity\UserEntity;
use App\Model\Connect;
use PDO;

class UserRepository extends MainPdo
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

    public function userInfos(int $id): UserEntity
    {
        $sql = 'select users.id,name,mail,surname,slogan,banner,logo
        from users
        left join profile
        on users.id=uid
        where users.id=?';
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, UserEntity::class, null);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function findUserFromId(int $id): UserEntity
    {
        $sql = 'select name from ' . self::$table . ' where id=?';
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, UserEntity::class, null);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function userLinks(int $id): array
    {
        $sql = 'select url from socials where uid=?';
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, UserEntity::class, null);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

}
