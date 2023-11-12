<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\CommentRepository;
use App\Entity\CommentEntity;
use App\Model\CommentModel;

class CommentService
{
    private static $instance;
    private readonly CommentRepository $commentRepository;

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

    public function getComment(int $id): CommentModel
    {
        $commentEntity = $this->commentRepository->findCommentsFromId($id);
        return CommentModel::fromFetch($commentEntity);
    }

    public function getComments(int $id): array
    {
        return $commentEntity = $this->commentRepository->commentsByPost($id);
        //return CommentModel::fromFetchAll($commentEntity);
    }


    public function commentSave(string $postId, string $comment): string
    {
        $values = [
            'uid' => $_SESSION['uid'],
            'bid' => $postId,
            'txt' => $comment,
            'pub' => 1
        ];
        return $this->commentRepository->commentSave($values);
    }

}
