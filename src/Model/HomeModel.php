<?php

declare(strict_types=1);

namespace App\Model;

use App\Entity\UserEntity;

class HomeModel
{
    private static $instance;
    private UserEntity $entity;

    private function __construct($entity)
    {
        $this->entity = $entity;
    }

    public static function getInstance($entity): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($entity);
        }
        return self::$instance;
    }

    public function specifyEntity(): UserEntity
    {
        return $this->entity;
    }

}
