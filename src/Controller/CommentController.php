<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\TemplateController;
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

        if ($error) {
            $datas = ['postId' => $postId, 'comment' => $comment, 'error' => $error];
            $this->renderHtml($datas, 'formcomment');
        } else {
            $id = $this->commentService->commentSave($postId, $comment);
            //todo recup username,date... if we let that like that
            $datas = ['surname' => $userId, 'txt' => $comment, 'date' => ''];
            $this->renderHtml($datas, 'publishedcomment');
        }
    }

}
