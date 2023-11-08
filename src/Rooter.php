<?php

namespace App;

use App\Controller\ArticleController;
use App\Controller\CategoryController;
use App\Controller\HomeController;
use App\Controller\UserController;
use App\Controller\CommentController;

class Rooter
{
    public function __construct()
    {
        //boot
    }

    public function index(array $gets): void
    {
        //pr($gets);
        $com = $gets['com'] ?? 'home'; //default
        $id = $gets['p1'] ?? 1; //default
        $target = get('_tg');
        $ajaxMode = $target ? 'true' : 'false';
        $articleController = ArticleController::getInstance($ajaxMode);
        $categoryController = CategoryController::getInstance($ajaxMode);
        $userController = UserController::getInstance($ajaxMode);
        $homeController = HomeController::getInstance($ajaxMode);
        $commentController = CommentController::getInstance($ajaxMode);
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
            'registerUser' => $userController->registerUser($gets),
            'login' => $userController->loginRoot(),
            'logon' => $userController->authentification($gets),
            'logout' => $userController->logout($gets),
            'newPost' => $articleController->newPost(),
            'postSave' => $articleController->postSave($gets),
            'postEdit' => $articleController->postEdit($gets),
            'postUpdate' => $articleController->postUpdate($gets),
            'newComment' => $commentController->newComment($gets),
            'postComment' => $commentController->commentSave($gets),
            default => $articleController->displayPost(1)
        };
    }
}
