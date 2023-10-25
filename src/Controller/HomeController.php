<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\TemplateController;
use App\Service\HomeService;
use App\Service\UserService;

class HomeController extends BaseController
{
    private static $instance;
    private HomeService $homeService;
    private UserService $userService;

    private function __construct(string $ajaxMode)
    {
        $this->homeService = HomeService::getInstance();
        $this->userService = UserService::getInstance();
        parent::__construct($ajaxMode);
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
        $array['results'] = $profile;
        $links = $this->userService->getLinks($id);
        foreach ($links as $link) {
            $array['links'][] = ['url' => $link->url];
        }
        $this->renderHtml($array, 'profile');
    }

}
