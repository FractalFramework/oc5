<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\MainPdo;
use App\Model\Connect;
use App\Entity\ArticleEntity;
use App\Model\ArticleModel;
use PDO;

class ArticleRepository extends MainPdo
{
    protected static string $table = 'posts';
    private static $instance;
    private Connect $connect;
    private ArticleModel $articleModel;

    private function __construct()
    {
        $this->connect = Connect::getInstance();
        $this->articleModel = ArticleModel::getInstance();
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getById(int $id): ArticleEntity //ArticleModel//ArticleEntity
    {
        $sql = 'select id,title,content from posts where id=?';
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ArticleEntity::class, null);
        $stmt->execute([$id]);
        $array = $stmt->fetch();
        return $array;
        //return $this->articleModel->specifyDatas($array);
    }

    public function getAll(int $limit = 10): array
    {
        $sql = 'select ' . self::$table . '.id,title,excerpt,category
        from ' . self::$table . '
        left join cats
        on cats.id=catid
        order by ' . self::$table . '.up desc
        limit ' . $limit;

        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ArticleEntity::class, null);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLasts(int $limit = 10): array
    {
        $sql = 'select ' . self::$table . '.id,title,excerpt,category
        from ' . self::$table . '
        left join cats
        on cats.id=catid
        limit ' . $limit;

        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ArticleEntity::class, null);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByCategory(int $catid = 1): array
    {
        $sql = 'select ' . self::$table . '.id,title,excerpt,content,category
        from ' . self::$table . '
        left join cats
        on cats.id=catid
        where catid=?
        order by ' . self::$table . '.up desc';

        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ArticleEntity::class, null);
        $stmt->execute([$catid]);
        return $stmt->fetchAll();
    }

}
