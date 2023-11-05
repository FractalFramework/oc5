<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\MainPdo;
use App\Entity\CommentEntity;
use App\Model\Connect;
use PDO;

class CommentRepository extends MainPdo
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

    public function findCommentsFromId(int $id): CommentEntity
    {
        $sql = 'select profile.uid,bid,txt,pub,surname
        from ' . self::$table . '
        left join profile
        on tracks.id=profile.uid
        where tracks.id=?';
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, CommentEntity::class, null);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function commentsByPost(int $id): array
    {
        $sql = 'select profile.uid,bid,txt,pub,surname,date_format(tracks.up,"%d/%m/%Y") as date
        from ' . self::$table . '
        left join profile
        on tracks.id=profile.uid
        where tracks.bid=?';
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, CommentEntity::class, null);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

}
