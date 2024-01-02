<?php

declare(strict_types=1);

namespace App\Model;

use App\Entity\CommentEntity;

class CommentModel
{
    public int $id;
    public int $uid;
    public int $bid;
    public string $name;
    public string $mail;
    public ?string $surname;
    public ?string $title;
    public string $txt;
    public string $date;
    public int $pub;

}
