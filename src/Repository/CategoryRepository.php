<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\CategoryEntity;
use App\Model\Connect;
use PDO;

class CategoryRepository
{
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

    private function fetchCategory(string $sql, array $blind): CategoryEntity|bool
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

    private function insertCategory(string $sql, array $blind): string|bool
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, CategoryEntity::class, null);
        $stmt->execute($blind);
        return $pdo->lastInsertId();
    }

    # sql 

    public function allCategories(): array
    {
        $sql = 'select id,category from cats';
        return $this->fetchAllCategories($sql, []);
    }

    public function findCategoryFromId(int $id): CategoryEntity
    {
        $sql = 'select category from cats where id=?';
        return $this->fetchCategory($sql, [$id]);
    }

    public function findIdFromCategoryName(string $category): CategoryEntity|bool
    {
        $sql = 'select id from cats where category=?';
        return $this->fetchCategory($sql, [$category]);
    }

    public function CreateCategory(string $category): string
    {
        $sql = 'insert into cats values (null, :category, now())';
        return $this->insertCategory($sql, ['category' => $category]);
    }

}
