<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\TemplateController;
use App\Service\HomeService;
use App\Service\UserService;

class HomeController
{
    private $prefix = '';
    private static $instance;
    private HomeService $homeService;
    private UserService $userService;

    private function __construct(string $prefix)
    {
        $this->prefix = $prefix;
        $this->homeService = HomeService::getInstance();
        $this->userService = UserService::getInstance();
    }

    public static function getInstance(string $target): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($target);
        }
        return self::$instance;
    }

    public function displayHome(int $id = 1): void
    {
        $profile = $this->homeService->getHome($id);
        $template_page = $this->prefix . 'profile';
        $template = new TemplateController($template_page);
        $array['results'] = $profile;
        $links = $this->userService->getLinks($id);
        foreach ($links as $link) {
            $array['links'][] = ['url' => $link->url];
        }

        $template->call($array);
    }

}
