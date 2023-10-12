<?php

declare(strict_types=1);

namespace App\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class AbstractTemplateController
{
    private $loader;
    protected $twig;
    protected $template = 'main';
    public function __construct(string $template)
    {
        $this->loader = new FilesystemLoader('src/View/Template');
        $this->twig = new Environment($this->loader);
        $this->template = $template;
    }
}
