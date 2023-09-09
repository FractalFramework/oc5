<?php
ini_set('display_errors','1');
error_reporting(E_ALL);
session_start();

function pr($r){echo '<pre>'.print_r($r,true).'</pre>';}
function atr($r){$ret=''; if($r)foreach($r as $k=>$v)if($v||$v==0)$ret.=' '.$k.'="'.$v.'"'; return $ret;}
function tag($b,$p,$d){return '<'.$b.atr($p).'>'.$d.'</'.$b.'>';}
function scandirs($d,$r=[]){$dr=opendir($d);
    while($f=readdir($dr))if($f!='..' && $f!='.'){$df=$d.'/'.$f;
        if(is_dir($df)){$r[]=$df; $r+=scandirs($df,$r);}}
    return $r;}
/**/spl_autoload_register(function($a){
    $r=scandirs('..'); //pr($r);
    if($r)foreach($r as $v)if(is_file($f=$v.'/'.$a.'.php')){require($f); return;}
});

define('ROOT',__DIR__.'/..');
//require ROOT.'/Vendor/autoload.php';
//$loader->add('App', __DIR__.'/../src/');
if(class_exists('Composer\\Autoload\\ClassLoader')){
    echo 'ooo';
    //require_once 'src/core/Database.php';
}

//use App;

#1

//$db=new Connect();//Src\Core\
//$datas=$db->query('select name from users where id = 1','User');//App\
/*
$datas=$db->query('select id,title,content from posts where id=1','Article');//App\
//pr($datas);
$rt=[];
foreach($datas as $k=>$post){
    $rt[$k][]=$post->getUrl();
    $rt[$k][]=$post->getTitle();
    $rt[$k][]=$post->getContent();
}
*/
    /*$rt[$k][]=$post->id;
    $rt[$k][]=$post->title;
    $rt[$k][]=$post->content;*/

#2

//$datas=$db->prepare('select id,title,content from posts where id=?',[1],'Article',1);//Src\App\
/*$datas=Article::post(1);//Src\App\
$rt=[];
$rt[]=$datas->getUrl();
$rt[]=$datas->getTitle();
$rt[]=$datas->getContent();
pr($rt);*/

#3

/*
$datas=Article::lasts();
$ret=''; pr($datas);
foreach($datas as $post){
    $ret.=tag('h2',[],$post->title);
    $ret.=tag('div',[],$post->category);
    $ret.=tag('div',[],$post->content);
}
echo $ret;*/

$page=new Pages();
//echo $page->Home();
//echo $page->Article(1);
//echo $page->Categories();
//echo $page->Category(1);
echo $page->artByCat(2);

?>