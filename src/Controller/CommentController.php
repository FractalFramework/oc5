<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\CommentService;
use App\Service\UserService;

class CommentController extends BaseController
{
    private static $instance;
    private readonly CommentService $commentService;
    private readonly UserService $userService;

    private function __construct(string $ajaxMode)
    {
        $this->commentService = CommentService::getInstance();
        $this->userService = UserService::getInstance();
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
        $this->renderHtml($array, 'comment');
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
        $requests['loged'] = filter_var($_SESSION['uid'] ?? false);
        $this->renderHtml($requests, 'formcomment');
    }

    public function commentSave($requests): void
    {
        $userId = filter_var($_SESSION['uid'] ?? 0);
        $postId = $requests['postId'];
        $name = $requests['name'];
        $mail = $requests['mail'];
        $comment = $requests['comment'];

        if ($userId) {
            $user = $this->userService->getUserFromUid((int) $userId);
            $name = $user->name;
            $mail = $user->mail;
        }

        $error = match (true) {
            !$postId => 'Une erreur est survenue : pas d\'article référant',
            !$name => 'Indiquez votre nom',
            !$mail => 'Indiquez votre mail',
            !filter_var($mail, FILTER_VALIDATE_EMAIL) => 'Votre e-mail est incorrect',
            !$comment => 'Si rien à dire c\'est pas la peine',
            default => ''
        };

        if ($error) {
            $requests['error'] = $error;
            $this->renderHtml($requests, 'formcomment');
        } else {
            $id = $this->commentService->commentSave($postId, $name, $mail, $comment);
            $requests['justPosted'] = $id;
            $this->renderHtml($requests, 'publishedcomment');
        }
    }

}
