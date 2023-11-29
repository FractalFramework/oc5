<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\CommentRepository;
use App\Model\CommentModel;
use App\Mapper\CommentMapper;

class CommentService
{
    private static $instance;
    private readonly CommentRepository $commentRepository;
    private readonly CommentMapper $commentMapper;

    private function __construct()
    {
        $this->commentRepository = CommentRepository::getInstance();
        $this->commentMapper = CommentMapper::getInstance();
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
        return $this->commentMapper->fromFetch($commentEntity);
    }

    public function getComments(int $id): array
    {
        $commentEntity = $this->commentRepository->commentsByPost($id);
        return $this->commentMapper->fromFetchAll($commentEntity);
    }

    public function getDashboardComments(int $number): array
    {
        $articleEntities = $this->commentRepository->getAll($number);
        return $this->commentMapper->forDashboard($articleEntities); //transformer
    }

    public function getAllComments(int $limit): array
    {
        $commentEntity = $this->commentRepository->getAll($limit);
        return $this->commentMapper->fromFetchAll($commentEntity);
    }

    public function commentSave(string $postId, string $name, string $mail, string $comment): string
    {
        $uid = $_SESSION['uid'] ?? 0;
        $values = [
            'uid' => $uid,
            'bid' => $postId,
            'name' => $name,
            'mail' => $mail,
            'txt' => $comment,
            'pub' => $uid ? 1 : 0
        ];
        return $this->commentRepository->commentSave($values);
    }

    public function commentPub(int $id, int $publish): void
    {
        $this->commentRepository->commentPub($id, $publish);
    }

}
