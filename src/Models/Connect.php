<?php

declare(strict_types=1);
namespace App\Models;

use \PDO;

class Connect
{
    private ?object $pdo = null;

    public function __construct(private array $params = [])
    {
        if (!$params)
            $params = ['host' => 'localhost', 'user' => 'root', 'pass' => 'dev', 'base' => 'oc5'];
        $this->params = $params;
    }

    private function getPDO()
    {
        if (!$this->pdo) {
            ['host' => $host, 'user' => $user, 'pass' => $pass, 'base' => $base] = $this->params;
            $dsn = 'mysql:host=' . $host . ';dbname=' . $base . ';charset=utf8';
            $pdo = new PDO($dsn, $user, $pass);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    public function query(string $sql, string $class): array
    {
        $req = $this->getPDO()->query($sql);
        $datas = $req->fetchAll(PDO::FETCH_CLASS, $class);
        return $datas;
    }

    public function prepare(
        string $sql,
        array $queries,
        string $class,
        int $one
    ): object {
        $req = $this->getPDO()->prepare($sql);
        $req->execute($queries);
        $req->setFetchMode(PDO::FETCH_CLASS, $class);
        if ($one) {
            $datas = $req->fetch();
        } else {
            $datas = $req->fetchAll();
        }
        return $datas;
    }

}
