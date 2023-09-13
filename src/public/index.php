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

//use App\Public\Root;
//$page=new Root();
//echo $page->Home();
//echo $page->Article(1);
//echo $page->Categories();
//echo $page->Category(1);
//echo $page->artByCat(2);
