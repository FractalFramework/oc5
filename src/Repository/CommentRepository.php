<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\CommentEntity;
use App\Service\DbService;
use App\Model\Connect;
use PDO;

class CommentRepository
{
    protected static string $table = 'tracks';
    private static $instance;
    private DbService $dbService;
    private Connect $connect;

    private function __construct()
    {
        $this->dbService = DbService::getInstance();
        $this->connect = Connect::getInstance();
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function fetchComment(string $sql, array $blind): CommentEntity
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, CommentEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetch();
    }

    public function findCommentsFromId(int $id): CommentEntity
    {
        $sql = 'select profile.uid,bid,txt,pub,surname
        from ' . self::$table . '
        left join profile
        on tracks.id=profile.uid
        where tracks.id=?';
        return $this->fetchComment($sql, [$id]);
    }

    public function commentsByPost(int $id): array
    {
        $sql = 'select tracks.id,profile.uid,bid,txt,pub,name,surname,auth,date_format(tracks.up,"%d/%m/%Y") as date
        from ' . self::$table . '
        left join profile on tracks.uid=profile.uid
        left join users on tracks.uid=users.id
        where pub=1 and tracks.bid=?';
        return $this->dbService->fetchAllComments($sql, [$id]);
    }

    public function commentSave(array $blind): string
    {
        $sql = 'insert into ' . self::$table . ' values (null, :uid, :bid, :txt, :pub, now())';
        return $this->dbService->insertComment($sql, $blind);
    }

}
