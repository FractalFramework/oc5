<?php

namespace App\Controllers;
use App\Models\Main;
use App\Models\Db;

class User extends Main
{

    protected static $table='users';
    public $name='';

    public static function find($id)
    {
        $qr='select name from '.self::$table.' where id=?';
        return Db::getDb()->prepare($qr,[$id],'User',1);
    }

    public function getName()
    {
        return 'user/'.$this->name;
    }


}