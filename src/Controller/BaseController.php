<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\TemplateService;

class BaseController
{
    private $prefix = '';
    protected $template = 'pages/main.html.twig';
    private TemplateService $twigService;

    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
        $this->twigService = TemplateService::getInstance($prefix);
    }

    public function renderHtml(array $params, $htmlPage): void
    {
        $params['mtime'] = microtime(true);
        $this->template = $this->prefix . $htmlPage . TemplateService::ARTICLE_VIEW;
        $this->twigService->twig->display($this->template, $params);
    }

}
