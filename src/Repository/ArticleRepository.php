<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ArticleEntity;
use App\Service\DbService;
use PDO;

class ArticleRepository
{
    protected static string $table = 'posts';
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

    public function getById(int $id): ArticleEntity
    {
        $sql = 'select posts.id,uid,title,excerpt,content,category,pub,name,date_format(posts.lastup,"%d/%m/%Y") as date from posts 
        left join cats on posts.catid=cats.id
        left join users on posts.uid=users.id
        where posts.id=?';
        return $this->dbService->fetchArticle($sql, [$id]);
    }

    public function getAll(int $limit = 10): array
    {
        $sql = 'select ' . self::$table . '.id,title,excerpt,category
        from ' . self::$table . '
        left join cats
        on cats.id=catid
        order by ' . self::$table . '.up desc
        limit ' . $limit;
        return $this->dbService->fetchAllArticles($sql, []);
    }

    public function getLasts(int $limit = 10): array
    {
        $sql = 'select ' . self::$table . '.id,title,excerpt,category
        from ' . self::$table . '
        left join cats
        on cats.id=catid
        limit ' . $limit;
        return $this->dbService->fetchAllArticles($sql, []);
    }

    public function getByCategory(int $catid = 1): array
    {
        $sql = 'select ' . self::$table . '.id,title,excerpt,content,category
        from ' . self::$table . '
        left join cats
        on cats.id=catid
        where catid=?
        order by ' . self::$table . '.up desc';
        return $this->dbService->fetchAllArticles($sql, [$catid]);
    }

    public function postSave(array $blind): string
    {
        $sql = 'insert into ' . self::$table . ' values (null, :uid, :catid, :title, :excerpt, :content, :pub, now(), now())';
        return $this->dbService->insertArticle($sql, $blind);
    }

    public function postUpdate(array $blind): bool
    {
        $sql = 'update ' . self::$table . ' set catid=:catid, title=:title, excerpt=:excerpt, content=:content where id=:id';
        return $this->dbService->updateArticle($sql, $blind);
    }

}
