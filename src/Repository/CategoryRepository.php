<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\CategoryEntity;
use App\Model\Connect;
use PDO;

class CategoryRepository
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

    # fetches

    private function fetchCategory(string $sql, array $blind): CategoryEntity
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, CategoryEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetch();
    }

    private function fetchAllCategories(string $sql, array $blind): array
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, CategoryEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetchAll();
    }

    # sql 

    public function allCategories(): array
    {
        $sql = 'select id,category from ' . self::$table . '';
        return $this->fetchAllCategories($sql, []);
    }

    public function findCategoryFromId(int $id): CategoryEntity
    {
        $sql = 'select category from ' . self::$table . ' where id=?';
        return $this->fetchCategory($sql, [$id]);
    }

}
