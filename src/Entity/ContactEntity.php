<?php

namespace App\Entity;

class ContactEntity
{
    public int $id;
    public int $uid;
    public string $name;
    public string $mail;
    public string $message;
    public string $date;
    public int $pub;

}
