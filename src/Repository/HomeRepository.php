<?php

declare(strict_types=1);

namespace App\Repository;

use App\Service\DbService;
use App\Entity\UserEntity;

class HomeRepository
{
    protected static string $table = 'tracks';
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

    public function getProfile(int $id): UserEntity
    {
        $sql = 'select uid,bid,txt,pub,surname
        from ' . self::$table . '
        left join profile
        on tracks.id=uid
        where tracks.id=?';
        return $this->dbService->fetchUserProfile($sql, [$id]);
        /*$pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, UserEntity::class, null);
        $stmt->execute([$id]);
        return $stmt->fetch();*/
    }

}
