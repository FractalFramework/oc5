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
        $sql='select name from '.self::$table.' where id=?';
        $class='\App\Controllers\User';
        $blind=[$id];
        $one_result=1;
        return self::query($sql, $blind, $class, $one_result);
    }

    public function getName()
    {
        return 'user/'.$this->name;
    }


}