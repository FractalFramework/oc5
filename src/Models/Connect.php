<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

class Connect
{
    private ?object $pdo = null;

    public function __construct(private array $params = [])
    {
    }

    private function getPDO(): object
    {
        if (!$this->pdo) {
            ['host' => $host, 'user' => $user, 'pass' => $pass, 'base' => $base] = $this->params;
            $dsn = 'mysql:host=' . $host . ';dbname=' . $base . ';charset=utf8';
            $pdo = new PDO($dsn, $user, $pass);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    public function query(string $sql, string $class): object //wtf
    {
        $stmt = $this->getPDO()->query($sql);
        $datas = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_CLASSTYPE, $class);
        return $datas;
    }

    public function prepare(
        string $sql,
        array $queries,
        string $class,
        int $one
    ): object {
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $class); // | PDO::FETCH_CLASSTYPE
        $stmt->execute($queries);
        if ($one) {
            $datas = $stmt->fetch(PDO::FETCH_CLASS | PDO::FETCH_CLASSTYPE);
        } else {
            //echo $class;
            $datas = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_CLASSTYPE);
            //var_dump($datas);
        }
        return $datas;
    }

}
