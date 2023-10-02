<?php

namespace App;

use App\Controllers\ArticleController;
use App\Controllers\CategoryController;
use App\Controllers\UserController;
use App\Lib\Html;
use App\Lib\Php;
use App\Lib\Ses;

class Rooter
{

    public function home(): string
    {
        $datas = ArticleController::all();
        $ret = ''; //pr($datas);
        foreach ($datas as $post) {
            $ret .= Html::tag('h2', [], $post->title);
            $ret .= Html::tag('div', [], $post->category);
            $ret .= Html::tag('div', [], $post->content);
        }
        return $ret;
    }

    public function user(array $param): string
    {
        $id = $param['id'] ?? 0; //interessant
        $datas = UserController::find($id);
        $ret = '';
        $ret .= Html::tag('p', [], $datas->name);
        return $ret;
    }

    public function article(array $param): string
    {
        $id = $param['id'] ?? 1; //interessant
        $datas = ArticleController::post($id);
        $ret = '';
        $ret .= Html::tag('h2', [], $datas->title);
        $ret .= Html::tag('div', [], $datas->category);
        $ret .= Html::tag('div', [], $datas->content);
        return $ret;
    }

    public function last(): string
    {
        $datas = ArticleController::post(1);
        $ret = '';
        $ret .= Html::tag('h2', [], $datas->title);
        $ret .= Html::tag('div', [], $datas->category);
        $ret .= Html::tag('div', [], $datas->content);
        return $ret;
    }

    public function categories(): string
    {
        $datas = CategoryController::all();
        //$datas=CategoryController::categories();
        $ret = '';
        foreach ($datas as $cat) {
            $ret .= Html::tag('li', ['href' => $cat->id], $cat->category);
        }
        return Html::tag('ul', [], $ret);
    }

    public function category(): string
    {
        $page = new CategoryController();
        return $page->find(1)->category;
    }

    public function artByCat(array $param): string
    {
        $catid = $param['catid'] ?? 1; //interessant
        $datas = ArticleController::artByCat($catid); //pr($datas);
        $ret = '';
        foreach ($datas as $post) {
            $ret .= Html::tag('h2', [], $post->title);
            $ret .= Html::tag('div', [], $post->category);
            $ret .= Html::tag('div', [], $post->content);
        }
        return $ret;
    }
    public function test(): string
    {
        $ret = Html::ajaxLink('home', 'page 1', '') . ' ';
        $ret .= Html::ajaxLink('article/1', 'page 1', '') . ' ';
        $ret .= Html::ajax('target|article|id=1', 'article') . ' ';
        $ret .= Html::div('', '', 'target');
        return $ret;
    }

}
