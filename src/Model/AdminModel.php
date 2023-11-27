<?php

declare(strict_types=1);

namespace App\Model;

use App\Entity\ArticleEntity;
use App\Entity\CommentEntity;
use App\Entity\ContactEntity;

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

    //id,name,title,excerpt,category,pub,date_format
    public static function fetchArticles(array $entities): self
    {
        $model = new self();
        foreach ($entities as $entity) {
            $model->results[] = [
                'uid' => $entity->uid,
                'title' => $entity->title,
                'content' => $entity->content,
                'excerpt' => $entity->excerpt,
                'category' => $entity->category,
                'name' => $entity->name,
                'date' => $entity->date,
                'pub' => $entity->pub
            ];
        }
        return $model;
    }

    //tracks.id,profile.uid,bid,txt,pub,tracks.name,surname,pub,date
    public static function fetchComments(array $entity): self
    {
        $model = new self();
        $model->id = $entity->id;
        $model->uid = $entity->uid;
        $model->bid = $entity->bid;
        $model->content = $entity->txt;
        $model->name = $entity->name;
        $model->date = $entity->date;
        $model->pub = $entity->pub;
        return $model;
    }

    //uid,name,mail,msg,pub
    public static function fetchContacts(array $entity): self
    {
        $model = new self();
        $model->uid = $entity->uid;
        $model->name = $entity->name;
        $model->mail = $entity->mail;
        $model->msg = $entity->msg;
        $model->date = $entity->date;
        $model->pub = $entity->pub;
        return $model;
    }
}
