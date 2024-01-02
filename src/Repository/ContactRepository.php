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

    public function updateContact(string $sql, array $blind): bool
    {
        $pdo = $this->connect->pdo;
        $stmt = $pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, ContactEntity::class, null);
        return $stmt->execute($blind);
    }

    # sql

    public function getById(int $id): ContactEntity
    {
        $sql = 'select contacts.id,uid,contacts.name,contacts.mail,msg,pub,date_format(contacts.up,"%d/%m/%Y") as date from contacts 
        left join users on contacts.uid=users.id
        where contacts.id=?';
        return $this->fetchContact($sql, [$id]);
    }

    public function getAll(int $limit = 40): array
    {
        $sql = 'select contacts.id,uid,name,mail,msg,pub,date_format(contacts.up,"%d/%m/%Y") as date
        from contacts
        order by pub desc, contacts.up desc
        limit ' . $limit;
        return $this->fetchAllContacts($sql, []);
    }

    public function contactSave(string $name, string $mail, string $message): string
    {
        $blind = [
            'uid' => sesint('uid'),
            'name' => $name,
            'mail' => $mail,
            'msg' => $message,
            'pub' => 1
        ];
        $sql = 'insert into contacts values (null, :uid, :name, :mail, :msg, :pub, now())';
        return $this->insertContact($sql, $blind);
    }

    public function contactPub(int $id, int $publish): bool
    {
        $sql = 'update contacts set pub=:pub where id=:id';
        return $this->updateContact($sql, ['id' => $id, 'pub' => $publish]);
    }

}
