<?php

namespace App\Entity;

class CommentEntity
{
    public ?int $id;
    public ?int $uid;
    public ?int $bid;
    public ?string $name;
    public ?string $mail;
    public ?string $auth;
    public ?string $surname;
    public ?string $txt;
    public ?int $pub;
    public ?string $date;

    public function getId(): int
    {
        return $this->id;
    }
    public function getUid(): int
    {
        return $this->uid;
    }
    public function getBid(): int
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
    public function getAuth(): string
    {
        return $this->auth;
    }
    public function getSurname(): string
    {
        return $this->surname;
    }
    public function getTxt(): string
    {
        return $this->txt;
    }
    public function getPub(): int
    {
        return $this->pub;
    }
    public function getDate(): string
    {
        return $this->date;
    }

}
