<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Repositories\TemplateRepository;

class TemplateController extends TemplateRepository
{

    public function call(array $params): void
    {
        $params['mtime'] = microtime(true);
        $this->twig->display($this->template . '.html.twig', $params);
    }

}
