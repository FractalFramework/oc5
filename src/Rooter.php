<?php

namespace App;

use App\Controller\ArticleController;
use App\Controller\CategoryController;
use App\Controller\HomeController;
use App\Controller\UserController;
use App\Controller\CommentController;
use App\Controller\ContactController;
use App\Controller\AdminController;

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
        $id = $gets['p1'] ?? 1; //from param "p1"
        $id = (int) $id;
        $target = get('_tg');
        $ajaxMode = $target ? 'true' : 'false';
        $articleController = ArticleController::getInstance($ajaxMode);
        $categoryController = CategoryController::getInstance($ajaxMode);
        $userController = UserController::getInstance($ajaxMode);
        $homeController = HomeController::getInstance($ajaxMode);
        $commentController = CommentController::getInstance($ajaxMode);
        $contactController = ContactController::getInstance($ajaxMode);
        $adminController = AdminController::getInstance($ajaxMode);
        match ($com) {
            'home' => $homeController->displayHome(1),
            'post' => $articleController->displayPost($id),
            'posts' => $articleController->displayPosts(),
            'articles' => $articleController->displayPosts(),
            'category' => $articleController->displayCategory($id),
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
            'postEdit' => $articleController->postEdit($id),
            'postUpdate' => $articleController->postUpdate($gets),
            'newComment' => $commentController->newComment($gets),
            'postComment' => $commentController->commentSave($gets),
            'displayComment' => $commentController->displayComment($id),
            'displayContact' => $contactController->displayContact($id),
            'displayContacts' => $contactController->displayContacts(),
            'contact' => $contactController->newContact(),
            'contactSave' => $contactController->contactSave($gets),
            'admin' => $adminController->dashboard($gets),
            'adminArticles' => $adminController->reviewArticles(),
            'adminMyArticles' => $adminController->reviewMyArticles(),
            'adminComments' => $adminController->reviewComments(),
            'adminContacts' => $adminController->reviewContacts(),
            'adminArticlePub' => $adminController->articlePub($gets),
            'adminCommentPub' => $adminController->commentPub($gets),
            'adminContactPub' => $adminController->contactPub($gets),
            'contactPub' => $contactController->contactPub($gets),
            'readme' => $userController->readme($gets),
            default => $articleController->displayPost(1)
        };
    }
}
