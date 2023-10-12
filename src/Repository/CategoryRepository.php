<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\MainPdo;
use App\Entity\CategoryEntity;
use App\Model\Connect;
use PDO;

class CategoryRepository extends MainPdo
{
    protected static string $table = 'cats';
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

    public function allCategories(): array
    {
        $sql = 'select id,category from ' . self::$table . '';
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, CategoryEntity::class, null);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findCategoryFromId(int $id): CategoryEntity
    {
        $sql = 'select category from ' . self::$table . ' where id=?';
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, CategoryEntity::class, null);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

}
