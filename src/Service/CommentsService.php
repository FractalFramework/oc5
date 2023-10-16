<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\CommentsRepository;
use App\Entity\CommentsEntity;

class CommentsService
{
    private static $instance;
    private CommentsRepository $commentsRepository;

    private function __construct()
    {
        $this->commentsRepository = CommentsRepository::getInstance();
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getComment(int $id): CommentsEntity
    {
        return $this->commentsRepository->findCommentsFromId($id);
    }

    public function getComments(int $id): array
    {
        return $this->commentsRepository->commentsByPost($id);
    }

}
