<?php

namespace App\Pdo;

class User
{

    public ?string $name = '';

    public function getName(): string
    {
        return 'user/' . $this->name;
    }

}
