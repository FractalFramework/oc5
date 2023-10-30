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

    public function registerUser($gets): void
    {
        $name = $gets['name'];
        $mail = $gets['mail'];
        $pswd = $gets['pswd'];
        $psw2 = $gets['psw2'];
        $error = '';

        if ($pswd != $psw2)
            $error = 'Les mots de passe ne correspondent pas';
        elseif (!$pswd)
            $error = 'Spécifier un mot de passe';
        elseif (!$mail)
            $error = 'Spécifier un e-mail';
        elseif (!$name)
            $error = 'Spécifier un nom d\'utilisateur';
        if ($error)
            $this->renderHtml(['error' => $error, 'name' => $name], 'login');
        else {
            $uid = $this->userService->registerUser($name, $mail, $pswd);
            $error = $uid ? 0 : 1;
            if ($error)
                $this->renderHtml(['name' => $name, 'error' => 'Echec de l\'enregistrement'], 'notloged');
            else {
                $this->logon($name, $uid);
                $this->renderHtml(['name' => $name, 'welcome' => 'Inscription réussie'], 'loged');
            }
        }
    }

    public function logout(): void
    {
        unset($_SESSION['usr']);
        unset($_SESSION['uid']);
        $this->loginRoot();
    }

    public function logon(string $name, string $uid): void
    {
        $_SESSION['usr'] = $name;
        $_SESSION['uid'] = $uid;
    }

    public function authentification(array $gets): void
    {
        $name = $gets['name'];
        $pswd = $gets['pswd'];
        $error = '';
        if (!$name)
            $error = 'Spécifier nom d\'utilisateur';
        elseif (!$pswd)
            $error = 'Spécifier mot de passe';
        else {
            $userEntity = $this->userService->getUserFromName($name);
            $isUser = $userEntity->name ?? '' == $name ? 1 : 0;
            $uid = $userEntity->id ?? '';
            $isGoodPassword = password_verify($pswd, $userEntity->pswd ?? '');
            if (!$isUser)
                $error = 'Utilisateur inconnu';
            elseif (!$isGoodPassword)
                $error = 'Mot de passe non reconnu';
            else
                $this->logon($name, $uid);
        }
        if ($error)
            $this->renderHtml(['name' => $name, 'error' => $error], 'login');
        else
            $this->renderHtml(['name' => $name, 'welcome' => 'Authentification réussie'], 'loged');
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
        $this->renderHtml(['name' => $_SESSION['usr']], 'logout');
    }

    public function loginRoot(): void
    {
        if (isset($_SESSION['usr']))
            $this->displayLogOut();
        else
            $this->displayLoginForm();
    }

}
