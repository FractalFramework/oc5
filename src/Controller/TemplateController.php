<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AbstractTemplateController;

class TemplateController extends AbstractTemplateController
{

    public function call(array $params): void
    {
        $params['mtime'] = microtime(true);
        $tmp = $this->template . '.html.twig';
        $this->twig->display($tmp, $params);
    }

}
