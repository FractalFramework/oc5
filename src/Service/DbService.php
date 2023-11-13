<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Connect;
use App\Entity\ArticleEntity;
use App\Entity\CommentEntity;
use App\Entity\CategoryEntity;
use App\Entity\UserEntity;
use App\Entity\ContactEntity;
use PDO;

class DbService
{
    private static $instance;
    private static $className;
    private Connect $connect;

    private function __construct(string $className = '')
    {
        self::$className = $className;
        $this->connect = Connect::getInstance();
    }

    public static function getInstance(string $className = ''): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($className);
        }
        return self::$instance;
    }

    #Basic actions

    public function fetch(string $sql, array $blind): object
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::$className, null);
        $stmt->execute($blind);
        return $stmt->fetch();
    }

    public function fetchAll(string $sql, array $blind): array
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::$className, null);
        $stmt->execute($blind);
        return $stmt->fetchAll();
    }

    public function insert(string $sql, array $blind): string
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::$className, null);
        $stmt->execute($blind);
        return $pdo->lastInsertId();
    }

    public function update(string $sql, array $blind): bool
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, self::$className, null);
        return $stmt->execute($blind);
    }


    #Articles

    public function fetchArticle(string $sql, array $blind): ArticleEntity
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ArticleEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetch();
    }

    public function fetchAllArticles(string $sql, array $blind): array
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ArticleEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetchAll();
    }

    public function insertArticle(string $sql, array $blind): string
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

    #Comments

    public function fetchComment(string $sql, array $blind): CommentEntity
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, CommentEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetch();
    }

    public function fetchAllComments(string $sql, array $blind): array
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, CommentEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetchAll();
    }

    public function insertComment(string $sql, array $blind): string
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, CommentEntity::class, null);
        $stmt->execute($blind);
        return $pdo->lastInsertId();
    }

    #Category

    public function fetchCategory(string $sql, array $blind): CategoryEntity
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, CategoryEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetch();
    }

    public function fetchAllCategories(string $sql, array $blind): array
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, CategoryEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetchAll();
    }

    #Home

    public function fetchUserProfile(string $sql, array $blind): UserEntity
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, UserEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetch();
    }

    #User

    public function fetchUser(string $sql, array $blind): UserEntity|bool
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, UserEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetch();
    }

    public function fetchAddUser(string $sql, array $blind): string
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, UserEntity::class, null);
        //$stmt->bindParam(':name', $name, PDO::PARAM_STR);
        //$stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
        //$stmt->bindParam(':pswd', $pswd, PDO::PARAM_STR);
        $stmt->execute($blind);
        return $pdo->lastInsertId();
    }

    public function fetchAllSocials(string $sql, array $blind): array
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, UserEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetchAll();
    }

    #Contacts

    public function fetchContact(string $sql, array $blind): ContactEntity
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ContactEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetch();
    }

    public function fetchAllContacts(string $sql, array $blind): array
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ContactEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetchAll();
    }

    public function insertContact(string $sql, array $blind): string
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ContactEntity::class, null);
        $stmt->execute($blind);
        return $pdo->lastInsertId();
    }

}
