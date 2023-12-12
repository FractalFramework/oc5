<?php

declare(strict_types=1);

namespace App\Model;

use App\Entity\ContactEntity;

class ContactModel
{
    public int $id;
    public int $uid;
    public string $name;
    public string $mail;
    public string $msg;
    public ?string $date;
    public int $pub;
    public array $results;
}
