<?php

declare(strict_types=1);

namespace App\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

//twigService
class TemplateService
{
    const ARTICLE_VIEW = '.html.twig'; //string
    private $loader;
    private static $instance;
    public readonly Environment $twig;

    private function __construct()
    {
        $this->loader = new FilesystemLoader('src/View/Template');
        $this->twig = new Environment($this->loader);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}
