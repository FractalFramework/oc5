<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\HomeService;
use App\Service\UserService;
use App\Service\ArticleService;
use App\Model\ArticleModel;

class HomeController extends BaseController
{
    private static $instance;
    private HomeService $homeService;
    private UserService $userService;
    private ArticleService $articleService;

    private function __construct(string $ajaxMode)
    {
        $this->homeService = HomeService::getInstance();
        $this->userService = UserService::getInstance();
        $this->articleService = ArticleService::getInstance();
        parent::__construct($ajaxMode);
    }

    public static function getInstance(string $target): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($target);
        }
        return self::$instance;
    }

    public function previewArticle(int $id): ArticleModel
    {
        return $this->articleService->getPost($id);
    }

    public function displayHome(int $id = 1, string $welcome = ''): void
    {
        $profile = $this->homeService->getHome($id);
        $array = [];
        $array['results'] = $profile;
        foreach ([1 => 1, 2, 3, 4, 18, 20] as $key => $id) {
            $array['preview']['post' . $key] = $this->previewArticle($id);
        }
        $links = $this->userService->getLinks($id);
        foreach ($links as $link) {
            $array['links'][] = ['url' => $link->url];
        }
        $array['presentation'] = $this->articleService->getPost(24);
        $array['jobs'] = $this->articleService->getPost(25);
        $array['welcome'] = $welcome;
        $array['name'] = sesvar('usr');
        $this->renderHtml($array, 'home');
    }

}
