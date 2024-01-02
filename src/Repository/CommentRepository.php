<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\CommentEntity;
use App\Model\Connect;
use PDO;

class CommentRepository
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

    private function fetchComment(string $sql, array $blind): CommentEntity
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, CommentEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetch();
    }

    private function fetchAllComments(string $sql, array $blind): array|int
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, CommentEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetchAll();
    }

    private function insertComment(string $sql, array $blind): string
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, CommentEntity::class, null);
        $stmt->execute($blind);
        return $pdo->lastInsertId();
    }

    public function updateComment(string $sql, array $blind): bool
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, CommentEntity::class, null);
        return $stmt->execute($blind);
    }

    # sql

    public function findCommentsFromId(int $id): CommentEntity
    {
        $sql = 'select profile.uid,bid,txt,pub,surname
        from tracks
        left join profile
        on tracks.id=profile.uid
        where tracks.id=?';
        return $this->fetchComment($sql, [$id]);
    }

    public function commentsByPost(int $id): array
    {
        $sql = 'select tracks.id,tracks.uid,tracks.mail,bid,txt,pub,bid,tracks.name,surname,date_format(tracks.up,"%d/%m/%Y") as date
        from tracks
        left join profile on tracks.uid=profile.uid
        left join users on tracks.uid=users.id
        where pub=1 and tracks.bid=?';
        return $this->fetchAllComments($sql, [$id]);
    }

    public function getAll(int $limit = 40): array
    {
        $sql = 'select tracks.id,tracks.uid,tracks.name,bid,title,txt,tracks.mail,tracks.name,surname,tracks.pub,date_format(tracks.up,"%d/%m/%Y") as date
        from tracks
        left join posts on tracks.id=posts.uid
        left join profile on tracks.uid=profile.uid
        left join users on tracks.uid=users.id
        order by date desc
        limit ' . $limit;
        return $this->fetchAllComments($sql, []);
    }

    public function commentSave(array $blind): string
    {
        $sql = 'insert into tracks values (null, :uid, :bid, :name, :mail, :txt, :pub, now())';
        return $this->insertComment($sql, $blind);
    }

    public function commentPub(int $id, int $publish): bool
    {
        $sql = 'update tracks set pub=:pub where id=:id';
        return $this->updateComment($sql, ['id' => $id, 'pub' => $publish]);
    }

}
