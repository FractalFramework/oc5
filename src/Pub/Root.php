<?php

namespace App\Pub;

use App\Controllers\ArticleController;
use App\Controllers\CategoryController;
use App\Controllers\UserController;

class Root
{
    function __construct()
    {
        require_once 'src/pub/lib.php';
    }

    public function home()
    {
        $datas = ArticleController::all();
        $ret = ''; //pr($datas);
        foreach ($datas as $post) {
            $ret .= tag('h2', [], $post->title);
            $ret .= tag('div', [], $post->category);
            $ret .= tag('div', [], $post->content);
        }
        return $ret;
    }

    public function user($id)
    {
        $datas = UserController::find($id);
        $ret = '';
        $ret .= tag('p', [], $datas->name);
        return $ret;
    }

    public function article()
    {
        $datas = ArticleController::post(1);
        $ret = '';
        $ret .= tag('h2', [], $datas->title);
        $ret .= tag('div', [], $datas->category);
        $ret .= tag('div', [], $datas->content);
        return $ret;
    }

    public function last()
    {
        $datas = ArticleController::post(1);
        $ret = '';
        $ret .= tag('h2', [], $datas->title);
        $ret .= tag('div', [], $datas->category);
        $ret .= tag('div', [], $datas->content);
        return $ret;
    }

    public function categories()
    {
        $datas = CategoryController::all();
        //$datas=CategoryController::categories();
        $ret = '';
        foreach ($datas as $cat) {
            $ret .= tag('li', ['href' => $cat->id], $cat->category);
        }
        return tag('ul', [], $ret);
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
            $ret .= tag('h2', [], $post->title);
            $ret .= tag('div', [], $post->category);
            $ret .= tag('div', [], $post->content);
        }
        return $ret;
    }

}
