<?php

declare(strict_types=1);

namespace App\Model;

class AdminModel
{

    public int $id;
    public int $uid;
    public int $bid;
    public string $title;
    public string $excerpt;
    public string $category;
    public string $content;
    public string $name;
    public string $date;
    public string $txt;
    public string $mail;
    public string $msg;
    public int $pub;
    public array $results;

    private function __construct()
    {
    }
}
