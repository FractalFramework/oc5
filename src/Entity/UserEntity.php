<?php

namespace App\Entity;

class UserEntity
{
    public ?string $name = '';

    public function getName(): string
    {
        return 'user/' . $this->name;
    }

}
