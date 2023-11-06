<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\TemplateController;
use App\Service\CommentService;

class CommentController extends BaseController
{
    private static $instance;
    private CommentService $commentService;

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

    public function displayComment(int $id = 1): void
    {
        $datas = $this->commentService->getComment($id);
        $array['result'] = $datas;
        $this->renderHtml($array, 'comments');
    }

    public function displayComments(int $id = 1): void
    {
        $datas = $this->commentService->getComments($id);
        $this->renderHtml($datas, 'comments');
    }

    public function newComment(): void
    {
        if (!isset($_SESSION['uid']))
            $this->renderHtml([], 'login');
        else
            $this->renderHtml([], 'formcomment');
    }

    public function commentSave($requests): void
    {
        $userId = $requests['userId'];
        $postId = $requests['postId'];
        $comment = $requests['comment'];

        $error = match (true) {
            !$userId => 'Vous n\'êtes pas identifié',
            !$postId => 'Une erreur est survenue : pas d\'article référant',
            !$comment => 'Si rien à dire c\'est pas la peine',
            default => ''
        };

        if ($error) {
            $this->renderHtml(['userId' => $userId, 'postId' => $postId, 'comment' => $comment, 'error' => $error], 'commentpost');
            return;
        }
    }

}
