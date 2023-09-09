<?php
//namespace App;

class Category extends Posts{

    protected static $table='cats';
    public $category='';
    public $id=0;

    /**/public static function all(){
        $qr='select id,category from '.self::$table.'';
        return Db::getDb()->query($qr,'Category');
    }

    public static function find($id){
        $qr='select category from '.self::$table.' where id=?';
        return Db::getDb()->prepare($qr,[$id],'Category',1);
    }

    public function getUrl(){
        return 'cat/'.$this->id;
    }


}