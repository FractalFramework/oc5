<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\TemplateController;
use App\Service\UserService;

class UserController
{
    private $prefix = '';
    private static $instance;
    private UserService $userService;

    private function __construct(string $target)
    {
        if ($target) {
            $this->prefix = 'alone_';
        }
        $this->userService = UserService::getInstance();
    }

    public static function getInstance(string $target): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($target);
        }
        return self::$instance;
    }

    public function displayName(int $id = 1): void
    {
        $datas = $this->userService->getUserName($id);
        $array['results']['name'] = $datas->name;
        $template_page = $this->prefix . 'user';
        $template = new TemplateController($template_page);
        $template->call($array);
    }
    public function displayProfile(int $id = 1): void
    {
        $datas = $this->userService->getUser($id);
        $template_page = $this->prefix . 'profile';
        $template = new TemplateController($template_page);
        $array['results'] = $datas;
        $template->call($array);
    }

}
