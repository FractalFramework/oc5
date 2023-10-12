<?php

declare(strict_types=1);

namespace App\Model;

use PDO;

class Connect
{
    public readonly PDO $pdo;
    private static $instance;

    private function __construct()
    {
        ['HOST' => $host, 'USER' => $user, 'PASS' => $pass, 'BASE' => $base] = $_ENV;
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
}
