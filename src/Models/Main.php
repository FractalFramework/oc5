<?php

namespace App\Models;
use App\Models\Db;

class Main
{

    private static $site='poo';

    public static function query($stmt,$prm=null,$one=false){
        if($prm)return Db::getDb()->prepare($stmt,$prm,get_called_class(),$one);
        return Db::getDb()->query($stmt,get_called_class(),0);
    }

    public function __get($key){
        $method='get'.ucfirst($key);
        $this->$key=$this->$method();
        return $this->$key;
    }
    
    public function getTitle(){
        return self::$site;
    }
    
    public function setTitle($t){
        return self::$site=$t;
    }

}