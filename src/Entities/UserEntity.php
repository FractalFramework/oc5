<?php

namespace App\Entities;

class UserEntity
{
    public ?string $name = '';

    public function getName(): string
    {
        return 'user/' . $this->name;
    }

}
