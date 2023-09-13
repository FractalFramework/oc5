<?php

$root=dirname(dirname(__DIR__)); 
require $root.'/vendor/autoload.php';

use App\Models\Connect;

$db=new Connect();
$datas=$db->query('select name from users where id = 1','\App\Controllers\User');
print_r($datas);
