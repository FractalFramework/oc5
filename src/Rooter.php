<?php

namespace App;

use App\Controllers\ArticleController;
use App\Controllers\CategoryController;
use App\Controllers\UserController;
use App\Lib\Html;

class Rooter
{
    function __construct()
    {
    }

    public function home()
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

    public function user($id)
    {
        $datas = UserController::find($id);
        $ret = '';
        $ret .= Html::tag('p', [], $datas->name);
        return $ret;
    }

    public function article()
    {
        $datas = ArticleController::post(1);
        $ret = '';
        $ret .= Html::tag('h2', [], $datas->title);
        $ret .= Html::tag('div', [], $datas->category);
        $ret .= Html::tag('div', [], $datas->content);
        return $ret;
    }

    public function last()
    {
        $datas = ArticleController::post(1);
        $ret = '';
        $ret .= Html::tag('h2', [], $datas->title);
        $ret .= Html::tag('div', [], $datas->category);
        $ret .= Html::tag('div', [], $datas->content);
        return $ret;
    }

    public function categories()
    {
        $datas = CategoryController::all();
        //$datas=CategoryController::categories();
        $ret = '';
        foreach ($datas as $cat) {
            $ret .= Html::tag('li', ['href' => $cat->id], $cat->category);
        }
        return Html::tag('ul', [], $ret);
    }

    public function category()
    {
        $page = new CategoryController();
        return $page->find(1)->category;
    }

    public function artByCat($catid)
    {
        $datas = ArticleController::artByCat($catid); //pr($datas);
        $ret = '';
        foreach ($datas as $post) {
            $ret .= Html::tag('h2', [], $post->title);
            $ret .= Html::tag('div', [], $post->category);
            $ret .= Html::tag('div', [], $post->content);
        }
        return $ret;
    }

}
