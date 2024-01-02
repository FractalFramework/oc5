<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\AdminRepository;
use App\Model\ErrorModel;

class AdminService
{
    private static $instance;
    private AdminRepository $userRepository;

    private function __construct()
    {
        $this->userRepository = AdminRepository::getInstance();
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }


}
