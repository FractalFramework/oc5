<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\CommentService;

class CommentController extends BaseController
{
    private static $instance;
    private readonly CommentService $commentService;

    private function __construct(string $ajaxMode)
    {
        $this->commentService = CommentService::getInstance();
        parent::__construct($ajaxMode);
    }

    public static function getInstance(string $target): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($target);
        }
        return self::$instance;
    }

    public function displayComment(int $id): void
    {
        $array['result'] = $this->commentService->getComment($id);
        $this->renderHtml($array, 'comments');
    }

    public function displayComments(int $id = 1): void
    {
        $this->renderHtml(
            $this->commentService->getComments($id),
            'comments'
        );
    }

    public function newComment(array $requests): void
    {
        $postId = $requests['postId'];
        if (!isset($_SESSION['uid']))
            $this->renderHtml([], 'login');
        else
            $this->renderHtml(['postId' => $postId], 'formcomment');
    }

    public function commentSave($requests): void
    {
        $userId = $_SESSION['uid'];
        $postId = $requests['postId'];
        $comment = $requests['comment'];

        $error = match (true) {
            !$userId => 'Vous n\'êtes pas identifié',
            !$postId => 'Une erreur est survenue : pas d\'article référant',
            !$comment => 'Si rien à dire c\'est pas la peine',
            default => ''
        };

        $datas = ['postId' => $postId];
        if ($error) {
            $datas['comment'] = $comment;
            $datas['error'] = $error;
        } else {
            $id = $this->commentService->commentSave($postId, $comment);
        }
        //render is sent in div id=comments
        $datas['comments'] = $this->commentService->getcomments((int) $postId);
        $this->renderHtml($datas, 'comments');
    }

}
