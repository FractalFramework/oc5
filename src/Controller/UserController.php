<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\TemplateController;
use App\Service\UserService;

class UserController extends BaseController
{
    private static $instance;
    private UserService $userService;

    private function __construct(string $ajaxMode)
    {
        $this->userService = UserService::getInstance();
        parent::__construct($ajaxMode);
    }

    public static function getInstance(string $ajaxMode): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($ajaxMode);
        }
        return self::$instance;
    }

    public function displayName(int $id = 1): void
    {
        $datas = $this->userService->getUserName($id);
        $array['results']['name'] = $datas->name;
        $this->renderHtml($array, 'user');
    }
    public function displayProfile(int $id = 1): void
    {
        $datas = $this->userService->getUser($id);
        $array['results'] = $datas;
        $this->renderHtml([], 'login');
    }
    public function displayRegisterForm(): void
    {
        $this->renderHtml([], 'register');
    }
    public function displayLoginForm(): void
    {
        $this->renderHtml([], 'login');
    }
    public function displayLogOut(): void
    {
        $this->renderHtml([], 'login');
    }
    public function loginRoot(): void
    {
        if (isset($_SESSION['usr']))
            $this->displayLogOut();
        else
            $this->displayLoginForm();
    }

    public function registerUser(): void
    {
        $this->renderHtml([], 'login');
    }
    public function loginUser(): void
    {
        $this->renderHtml([], 'login');
    }


}
