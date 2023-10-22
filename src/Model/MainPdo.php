<?php

declare(strict_types=1);

namespace App\Model;

class MainPdo
{
    public function __get(string $key): string
    {
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();
        return $this->$key;
    }

}
