<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\CategoryEntity;
use App\Service\DbService;

class CategoryRepository
{
    protected static string $table = 'cats';
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

    public function allCategories(): array
    {
        $sql = 'select id,category from ' . self::$table . '';
        return $this->dbService->fetchAllCategories($sql, []);
    }

    public function findCategoryFromId(int $id): CategoryEntity
    {
        $sql = 'select category from ' . self::$table . ' where id=?';
        return $this->dbService->fetchCategory($sql, [$id]);
    }

}
