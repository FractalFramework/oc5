<?php

declare(strict_types=1);
namespace App\Models;
use App\Models\Db;

class Main
{

    private static string $site='poo';

    public static function query($stmt,$prm=null,$one=false):object
    {
        if($prm)
        {
            return Db::getDb()->prepare($stmt, $prm,get_called_class(), $one);
        }
        return Db::getDb()->query($stmt, get_called_class(), $one);
    }

    public function __get($key):string
    {
        $method='get'.ucfirst($key);
        $this->$key=$this->$method();
        return $this->$key;
    }
    
    public function getTitle():string
    {
        return self::$site;
    }
    
    public function setTitle($t):string
    {
        return self::$site=$t;
    }

}