<?php

declare(strict_types=1);

namespace App\Model;

class ErrorModel
{
    public function __construct(public readonly string $message)
    {
    }

}
