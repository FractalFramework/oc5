<?php

namespace App;

use App\Controller\ArticleController;
use App\Controller\CategoryController;
use App\Controller\HomeController;
use App\Controller\UserController;

class Rooter
{
    public function __construct()
    {
        //boot
    }

    public function index(array $params): void
    {
        //pr($params);
        $com = $params['com'] ?? 'home'; //default
        $id = $params['p1'] ?? 1; //default
        $target = get('_tg');
        $ajaxMode = $target ? 'true' : 'false';
        $articleController = ArticleController::getInstance($ajaxMode);
        $categoryController = CategoryController::getInstance($ajaxMode);
        $userController = UserController::getInstance($ajaxMode);
        $homeController = HomeController::getInstance($ajaxMode);
        match ($com) {
            'home' => $homeController->displayHome(1),
            'post' => $articleController->displayPost((int) $id),
            'posts' => $articleController->displayPosts(),
            'lasts' => $articleController->displayLasts(),
            'category' => $articleController->displayCategory((int) $id),
            'categories' => $categoryController->displayCategories(),
            'user' => $userController->displayName($id),
            'profile' => $userController->displayProfile($id),
            'register' => $userController->displayRegisterForm(),
            'registerUser' => $userController->registerUser(),
            'login' => $userController->loginRoot(),
            'logon' => $userController->loginUser(),
            default => $articleController->displayPost(1)
        };
    }
}
