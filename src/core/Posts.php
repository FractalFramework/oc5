<?php
//namespace App;

class Posts{

//    public $id='';
//    public $title='';
//    public $content='';
//    public $url='';
    protected static $table='posts';
    private static $site='poo';

    public static function query($stmt,$prm=null,$one=false){
        if($prm)return Db::getDb()->prepare($stmt,$prm,get_called_class(),$one);
        return Db::getDb()->query($stmt,get_called_class(),0);
    }

    /*public static function categories(){
        $qr='select id,category from cats';
        return Db::getDb()->query($qr,'Category');
    }*/

    public function __get($key){
        $method='get'.ucfirst($key);
        $this->$key=$this->$method();
        return $this->$key;
    }

 /*   public function getTitle(){
        return $this->title;
    }
    public function getContent(){
        return $this->content;
    }*/
    
    public function getTitle(){
        return self::$site;
    }
    
    public function setTitle($t){
        return self::$site=$t;
    }

}