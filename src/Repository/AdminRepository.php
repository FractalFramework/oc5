<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\AdminEntity;
use App\Model\Connect;
use PDO;

class AdminRepository
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

}

