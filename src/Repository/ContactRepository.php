<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ContactEntity;
use App\Service\DbService;
use PDO;

class ContactRepository
{
    protected static string $table = 'contacts';
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

    public function getById(int $id): ContactEntity
    {
        $sql = 'select contacts.id,uid,title,excerpt,content,category,pub,name,date_format(contacts.lastup,"%d/%m/%Y") as date from contacts 
        left join cats on contacts.catid=cats.id
        left join users on contacts.uid=users.id
        where contacts.id=?';
        return $this->dbService->fetchContact($sql, [$id]);
    }

    public function getAll(int $limit = 10): array
    {
        $sql = 'select ' . self::$table . '.id,title,excerpt,category
        from ' . self::$table . '
        left join cats
        on cats.id=catid
        order by ' . self::$table . '.up desc
        limit ' . $limit;
        return $this->dbService->fetchAllContacts($sql, []);
    }

    public function contactSave(string $name, string $mail, string $message): string
    {
        $blind = [
            'uid' => $_SESSION['uid'] ?? 0,
            'name' => $name,
            'mail' => $mail,
            'message' => $message,
            'pub' => 1
        ];
        $sql = 'insert into ' . self::$table . ' values (null, :uid, :name, :mail, :message, :pub, now())';
        return $this->dbService->insertContact($sql, $blind);
    }

}
