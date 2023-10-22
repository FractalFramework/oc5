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
        $com = $params['com'] ?? 'test'; //default
        $id = $params['p1'] ?? 1;
        $target = get('_tg');
        $articleController = ArticleController::getInstance($target);
        $categoryController = CategoryController::getInstance($target);
        $userController = UserController::getInstance($target);
        $homeController = HomeController::getInstance($target);
        match ($com) {
            'home' => $homeController->displayHome(1),
            'post' => $articleController->displayPost((int) $id),
            'posts' => $articleController->displayPosts(),
            'lasts' => $articleController->displayLasts(),
            'category' => $articleController->displayCategory((int) $id),
            'categories' => $categoryController->displayCategories(),
            'user' => $userController->displayName($id),
            'profile' => $userController->displayProfile($id),
            default => $articleController->displayPost(1)
        };
    }
}
