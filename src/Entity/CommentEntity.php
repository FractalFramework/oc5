<?php

namespace App\Entity;

class CommentEntity
{
    public int $id;
    public ?int $uid;
    public int $bid;
    public string $name;
    public string $mail;
    public string $auth;
    public ?string $surname;
    public string $txt;
    public int $pub;
    public string $date;

}
