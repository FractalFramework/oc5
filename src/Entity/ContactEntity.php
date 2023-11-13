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

    public function getId(): int
    {
        return $this->id;
    }

    public function getUid(): int
    {
        return $this->uid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getPub(): int
    {
        return $this->pub;
    }

}
