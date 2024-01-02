<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\TemplateService;

class BaseController
{
    private $ajaxMode = '';
    protected $template = 'pages/main.html.twig';
    private TemplateService $twigService;

    public function __construct(string $ajaxMode)
    {
        $this->ajaxMode = $ajaxMode;
        $this->twigService = TemplateService::getInstance();
    }

    public function renderHtml(array $params, $htmlPage): void
    {
        $params['mtime'] = microtime(true);
        $params['page'] = $_GET['com'] ?? 'home';
        $params['ajaxMode'] = $this->ajaxMode;
        $params['admin'] = sesint('uid') == 1 ? true : false;
        $params['uid'] = sesint('uid');
        $params['usr'] = sesvar('usr');
        $this->template = 'pages/' . $htmlPage . TemplateService::ARTICLE_VIEW;
        $this->twigService->twig->display($this->template, $params);
    }

}
