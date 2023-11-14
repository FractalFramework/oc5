<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\UserEntity;
use App\Model\Connect;
use PDO;

class HomeRepository
{
    protected static string $table = 'tracks';
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

    private function fetchUserProfile(string $sql, array $blind): UserEntity
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, UserEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetch();
    }

    # sql

    public function getProfile(int $id): UserEntity
    {
        $sql = 'select uid,bid,txt,pub,surname
        from ' . self::$table . '
        left join profile
        on tracks.id=uid
        where tracks.id=?';
        return $this->fetchUserProfile($sql, [$id]);
    }

}
