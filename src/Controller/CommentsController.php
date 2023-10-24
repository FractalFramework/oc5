<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\TemplateController;
use App\Service\CommentsService;

class CommentsController
{
    private $prefix = '';
    private static $instance;
    private CommentsService $commentsService;

    private function __construct(string $prefix)
    {
        $this->prefix = $prefix;
        $this->commentsService = CommentsService::getInstance();
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
        $template_page = $this->prefix . 'comments';
        $template = new TemplateController($template_page);
        $array['result'] = $datas;
        $template->call($array);
    }

    public function displayComments(int $id = 1): void
    {
        $datas = $this->commentsService->getComments($id);
        $template_page = $this->prefix . 'comments';
        $template = new TemplateController($template_page);
        $array['results'] = $datas;
        $template->call($array);
    }

}
