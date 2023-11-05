<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\CommentRepository;
use App\Entity\CommentEntity;

class CommentService
{
    private static $instance;
    private CommentRepository $commentRepository;

    private function __construct()
    {
        $this->commentRepository = CommentRepository::getInstance();
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getComment(int $id): CommentEntity
    {
        return $this->commentRepository->findCommentsFromId($id);
    }

    public function getComments(int $id): array
    {
        return $this->commentRepository->commentsByPost($id);
    }

}
