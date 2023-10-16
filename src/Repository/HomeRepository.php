<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\MainPdo;
use App\Entity\UserEntity;
use App\Model\Connect;
use PDO;

class HomeRepository extends MainPdo
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

    public function getProfile(int $id): UserEntity
    {
        $sql = 'select uid,bid,txt,pub,surname
        from ' . self::$table . '
        left join profile
        on tracks.id=uid
        where tracks.id=?';
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, UserEntity::class, null);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

}
