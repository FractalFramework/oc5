<?php

declare(strict_types=1);

namespace App\Model;

use PDO;
use App\Entity\ArticleEntity;

class Connect
{
    public readonly PDO $pdo;
    private static $instance;

    private function __construct()
    {
        //pr($_ENV);
        ['HOST' => $host, 'USER' => $user, 'PASS' => $pass, 'BASE' => $base] = $_ENV;

        /*
       $host = $_ENV['HOST'];
       $user = $_ENV['USER'];
       $pass = $_ENV['PASS'];
       $base = $_ENV['BASE'];
       */

        $dsn = 'mysql:host=' . $host . ';dbname=' . $base . ';charset=utf8';
        $pdo = new PDO($dsn, $user, $pass);
        $this->pdo = $pdo;
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /*private function getPDO(): object
    {
        if (!$this->pdo) {
            ['host' => $host, 'user' => $user, 'pass' => $pass, 'base' => $base] = $this->params;
            $dsn = 'mysql:host=' . $host . ';dbname=' . $base . ';charset=utf8';
            $pdo = new PDO($dsn, $user, $pass);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    public function query(string $sql, string $class): array //wtf
    {
        $stmt = $this->pdo->query($sql);
        $datas = $stmt->fetchAll(PDO::FETCH_CLASS, $class);
        return $datas;
    }

    public function prepare(
        string $sql,
        array $queries,
        string $class,
        int $one
    ): object {
        $stmt = $this->pdo->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $class);
        $stmt->execute($queries);
        if ($one) {
            //$datas = $stmt->fetch(PDO::FETCH_OBJ);
            $datas = $stmt->fetch();
            //var_dump($datas);
        } else {
            //echo $class;
            $datas = $stmt->fetchAll();
        }
        return $datas;
    }
*/

}
