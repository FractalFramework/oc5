<?php

class Pages{

    public function Home(){
        $datas=Article::all();
        $ret=''; //pr($datas);
        foreach($datas as $post){
            $ret.=tag('h2',[],$post->title);
            $ret.=tag('div',[],$post->category);
            $ret.=tag('div',[],$post->content);
        }
        return $ret;
    }

    public function Article(){
        $datas=Article::post(1);
        $ret='';
        $ret.=tag('h2',[],$datas->title);
        $ret.=tag('div',[],$datas->category);
        $ret.=tag('div',[],$datas->content);
        return $ret;
    }

    public function Last(){
        $datas=Article::post(1);
        $ret='';
        $ret.=tag('h2',[],$datas->title);
        $ret.=tag('div',[],$datas->category);
        $ret.=tag('div',[],$datas->content);
        return $ret;
    }

    public function Categories(){
        $datas=Category::all();
        //$datas=Category::categories();
        $ret='';
        foreach($datas as $cat){
            $ret.=tag('li',['href'=>$cat->id],$cat->category);
        }
        return tag('ul',[],$ret);
    }

    public function Category(){
        $page=new Category();
        return $page->find(1)->category;
    }

    public function artByCat($catid){
        $datas=Article::artByCat($catid); //pr($datas);
        $ret='';
        foreach($datas as $post){
            $ret.=tag('h2',[],$post->title);
            $ret.=tag('div',[],$post->category);
            $ret.=tag('div',[],$post->content);
        }
        return $ret;
    }

}