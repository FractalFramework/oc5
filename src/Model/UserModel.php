<?php

declare(strict_types=1);

namespace App\Model;

class UserModel
{
    public function __construct(public readonly string $name, public readonly string $uid)
    {
    }

}
