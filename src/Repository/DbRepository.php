<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\MainPdo;
use App\Model\Connect;

//use PDO;

class DbRepository //extends MainPdo
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
}
