<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\TemplateController;
use App\Service\CommentsService;

class CommentsController extends BaseController
{
    private static $instance;
    private CommentsService $commentsService;

    private function __construct(string $ajaxMode)
    {
        $this->commentsService = CommentsService::getInstance();
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
        $datas = $this->commentsService->getComment($id);
        $array['result'] = $datas;
        $this->renderHtml($array, 'comments');
    }

    public function displayComments(int $id = 1): void
    {
        $datas = $this->commentsService->getComments($id);
        $this->renderHtml($datas, 'comments');
    }

}
