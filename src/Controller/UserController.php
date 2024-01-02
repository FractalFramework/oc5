<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\UserService;
use App\Model\ErrorModel;
use App\Model\UserModel;
use App\Controller\HomeController;


class UserController extends BaseController
{
    private static $instance;
    private UserService $userService;
    private HomeController $homeController;

    private function __construct(string $ajaxMode)
    {
        $this->userService = UserService::getInstance();
        $this->homeController = HomeController::getInstance($ajaxMode);
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
        $this->renderHtml($array, 'login');
    }

    public function registerUser($requests): void
    {
        $name = $requests['name'];
        $mail = $requests['mail'];
        $pswd = $requests['pswd'];
        $psw2 = $requests['psw2'];

        $error = match (true) {
            !$name && !$pswd => 'Spécifier nom d\'utilisateur et le mot de passe',
            !$name => 'Spécifier nom d\'utilisateur',
            !$pswd => 'Spécifier mot de passe',
            $pswd != $psw2 => 'Les mots de passe ne correspondent pas',
            !$mail => 'Spécifier un e-mail',
            !filter_var($mail, FILTER_VALIDATE_EMAIL) => 'Votre e-mail est incorrect',
            default => ''
        };

        if ($error) {
            $this->renderHtml(['name' => $name, 'error' => $error], 'login');
            return;
        }

        //user already exists //prevent double registering
        $result = $this->userService->getUserLoged($name, $pswd);
        if ($result instanceof UserModel) {
            $this->logon($result->name, $result->uid);
            $this->renderHtml(['name' => $result->name, 'welcome' => 'Authentification réussie'], 'loged');
            return;
        }

        //register user
        $uid = $this->userService->registerUser($name, $mail, $pswd);
        if (!$uid)
            $this->renderHtml(['name' => $name, 'error' => 'Echec de l\'enregistrement'], 'notloged');
        else {
            $this->logon($name, $uid);
            //$this->renderHtml(['name' => $name, 'welcome' => 'Inscription réussie'], 'loged');
            $this->homeController->displayHome(1, 'Inscription réussie');
        }

    }

    public function logout(): void
    {
        sesz('uid');
        sesz('usr');
        $this->loginRoot(1);
    }

    public function logon(string $name, string $uid): void
    {
        $_SESSION['usr'] = $name;
        $_SESSION['uid'] = $uid;
    }

    /*
    "tambouille" signifie qu'il faut :
        - identifier les erreurs (d'inputs) avant de lancer l'enquête
        - lancer l'enquête pour identifier les erreurs de validation
    */
    public function authentification(array $requests): void
    {
        $name = $requests['name'];
        $pswd = $requests['pswd'];

        $error = match (true) {
            !$name && !$pswd => 'Spécifier nom d\'utilisateur et le mot de passe',
            !$name => 'Spécifier nom d\'utilisateur',
            !$pswd => 'Spécifier mot de passe',
            default => ''
        };

        if ($error) {
            $this->renderHtml(['name' => $name, 'error' => $error], 'login');
            return;
        }

        $result = $this->userService->getUserLoged($name, $requests['pswd']);

        if ($result instanceof ErrorModel) {
            $this->renderHtml(['name' => $name, 'error' => $result->message], 'login');
            return;
        }

        //all is ok
        $this->logon($result->name, $result->uid);
        //$result = ['name' => $result->name, 'welcome' => 'Authentification réussie'];
        //$this->renderHtml($result, 'loged');
        $this->homeController->displayHome(1, 'Authentification réussie');
    }

    public function displayRegisterForm(): void
    {
        $this->renderHtml([], 'register');
    }

    public function displayLoginForm(int $unloged = 0): void
    {
        $this->renderHtml(['unloged' => $unloged], 'login');
    }

    public function displayLogOut(): void
    {
        $this->renderHtml(['name' => sesvar('usr')], 'logout');
    }

    public function loginRoot(int $unloged = 0): void
    {
        if (sesint('uid')) {
            $this->displayLogOut();
        } else
            $this->displayLoginForm($unloged);
    }

    public function readme(): void
    {
        $ret = files_struct('public');
        $ret .= files_struct('src');
        echo $ret;
    }

}
