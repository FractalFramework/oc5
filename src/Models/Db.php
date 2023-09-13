<?php

namespace App\Models;
use App\Models\Connect;

class Db
{
    private static $params=['host'=>'localhost', 'user'=>'root', 'pass'=>'dev', 'base'=>'oc5'];
    private static $db='';

    public static function getDb()
    {
        if(!self::$db)self::$db=new Connect(self::$params);
        return self::$db;
    }



}