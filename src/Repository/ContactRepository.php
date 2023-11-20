<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ContactEntity;
use App\Model\Connect;
use PDO;

class ContactRepository
{
    protected static string $table = 'contacts';
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

    private function fetchContact(string $sql, array $blind): ContactEntity
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ContactEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetch();
    }

    private function fetchAllContacts(string $sql, array $blind): array
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ContactEntity::class, null);
        $stmt->execute($blind);
        return $stmt->fetchAll();
    }

    private function insertContact(string $sql, array $blind): string
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ContactEntity::class, null);
        $stmt->execute($blind);
        return $pdo->lastInsertId();
    }

    # sql

    public function getById(int $id): ContactEntity
    {
        $sql = 'select ' . self::$table . '.id,uid,' . self::$table . '.name,contacts.mail,msg,pub,name,date_format(' . self::$table . '.lastup,"%d/%m/%Y") as date from ' . self::$table . ' 
        left join users on ' . self::$table . '.uid=users.id
        where contacts.id=?';
        return $this->fetchContact($sql, [$id]);
    }

    public function getAll(int $limit = 40): array
    {
        $sql = 'select ' . self::$table . '.id,uid,name,mail,msg,pub
        from ' . self::$table . '
        order by ' . self::$table . '.up desc
        limit ' . $limit;
        return $this->fetchAllContacts($sql, []);
    }

    public function contactSave(string $name, string $mail, string $message): string
    {
        $blind = [
            'uid' => $_SESSION['uid'] ?? 0,
            'name' => $name,
            'mail' => $mail,
            'msg' => $message,
            'pub' => 1
        ];
        $sql = 'insert into ' . self::$table . ' values (null, :uid, :name, :mail, :msg, :pub, now())';
        return $this->insertContact($sql, $blind);
    }

}
