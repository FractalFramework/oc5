<?php

namespace App\Entity;

class CommentsEntity
{
    public ?string $id = '';
    public ?string $name = '';
    public ?string $mail = '';
    public ?string $surname = '';
    public ?string $slogan = '';
    public ?string $banner = '';
    public ?string $logo = '';

    public function getId(): string
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getMail(): string
    {
        return $this->mail;
    }
    public function getSurname(): string
    {
        return $this->surname;
    }
    public function getSlogan(): string
    {
        return $this->slogan;
    }
    public function getBanner(): string
    {
        return $this->banner;
    }
    public function getLogo(): string
    {
        return $this->logo;
    }

}
