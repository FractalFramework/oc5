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
        $params['ajaxMode'] = $this->ajaxMode;
        $params['admin'] = ($_SESSION['uid'] ?? 0) == 1 ? true : false;
        $this->template = 'pages/' . $htmlPage . TemplateService::ARTICLE_VIEW;
        $this->twigService->twig->display($this->template, $params);
    }

}
