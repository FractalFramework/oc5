<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ArticleEntity;
use App\Model\Connect;
use PDO;

class ArticleRepository
{
    protected static string $table = 'posts';
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

    private function fetchArticle(string $sql, array $blind): ArticleEntity
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ArticleEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetch();
    }

    private function fetchAllArticles(string $sql, array $blind): array
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ArticleEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetchAll();
    }

    private function insertArticle(string $sql, array $blind): string
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ArticleEntity::class, null);
        $stmt->execute($blind);
        return $pdo->lastInsertId();
    }

    public function updateArticle(string $sql, array $blind): bool
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ArticleEntity::class, null);
        return $stmt->execute($blind);
    }

    # Sql

    public function getById(int $id): ArticleEntity|bool
    {
        $sql = 'select posts.id,uid,title,excerpt,content,category,pub,name,date_format(posts.lastup,"%d/%m/%Y") as date from posts 
        left join cats on posts.catid=cats.id
        left join users on posts.uid=users.id
        where posts.id=?';
        return $this->fetchArticle($sql, [$id]);
    }

    public function getAll(int $limit = 10): array
    {
        $sql = 'select posts.id,name,title,excerpt,category,pub,date_format(posts.lastup,"%d/%m/%Y") as date
        from posts
        left join cats on cats.id=catid
        left join users on users.id=uid
        order by posts.up desc
        limit ' . $limit;
        return $this->fetchAllArticles($sql, []);
    }

    public function getByCategory(int $catid = 1): array
    {
        $sql = 'select posts.id,title,excerpt,content,category
        from posts
        left join cats
        on cats.id=catid
        where catid=?
        order by posts.up desc';
        return $this->fetchAllArticles($sql, [$catid]);
    }

    public function postSave(string $catid, string $title, string $excerpt, string $content): string
    {
        $blind = [
            'uid' => $_SESSION['uid'],
            'catid' => $catid,
            'title' => $title,
            'excerpt' => $excerpt,
            'content' => $content,
            'pub' => 1
        ];
        $sql = 'insert into posts values (null, :uid, :catid, :title, :excerpt, :content, :pub, now(), now())';
        return $this->insertArticle($sql, $blind);
    }

    public function postUpdate(int $postId, string $catid, string $title, string $excerpt, string $content): bool
    {
        $blind = [
            'id' => $postId,
            'catid' => $catid,
            'title' => $title,
            'excerpt' => $excerpt,
            'content' => $content
        ];
        $sql = 'update posts set catid=:catid, title=:title, excerpt=:excerpt, content=:content where id=:id';
        return $this->updateArticle($sql, $blind);
    }

    public function articlePub(int $id, int $publish): bool
    {
        $sql = 'update posts set pub=:pub where id=:id';
        return $this->updateArticle($sql, ['id' => $id, 'pub' => $publish]);
    }

}
