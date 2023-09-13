<?php
ini_set('display_errors','1');
error_reporting(E_ALL);
session_start();

$root=dirname(dirname(__DIR__)); 
require $root.'/vendor/autoload.php';

use App\Models\Connect;

$db=new Connect();
$datas=$db->query('select name from users where id = 1','\App\Controllers\User');
print_r($datas);

#1

/*$datas=$db->query('select id,title,content from posts where id=1','\App\Controllers\Article');//App\
print_r($datas);
$rt=[];
foreach($datas as $k=>$post){
    $rt[$k][]=$post->getUrl();
    $rt[$k][]=$post->getTitle();
    $rt[$k][]=$post->getContent();
}*/

#2

/*
$datas=$db->prepare('select id,title,content from posts where id=?',[1],'\App\Controllers\Article',1);
print_r($datas);*/

/*
use App\Controllers\Article;
$datas=Article::post(1);//Src\App\
$rt=[];
$rt[]=$datas->getUrl();
$rt[]=$datas->getTitle();
$rt[]=$datas->getContent();
print_r($rt);*/

#3

/*use App\Controllers\Article;
$datas=Article::lasts();
$ret=''; print_r($datas);
foreach($datas as $post){
    $ret.=tag('h2',[],$post->title);
    $ret.=tag('div',[],$post->category);
    $ret.=tag('div',[],$post->content);
}
echo $ret;*/

use App\Public\Root;
$page=new Root();
//echo $page->Home();
//echo $page->Article(1);
//echo $page->Categories();
//echo $page->Category(1);
//echo $page->artByCat(2);

?>