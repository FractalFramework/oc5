<?php
//namespace App;

class Article extends Posts{

    public $id='';
    public $title='';
    public $content='';
    public $category='';
    protected static $table='posts';

/*    public function __get($key){
        $method='get'.ucfirst($key);
        $this->$key=$this->$method();
        return $this->$key;
    }*/

    /*public static function all(){
        $qr='select posts.id,title,content,category
        from posts
        left join cats
        on cats.id=catid';
        return Db::getDb()->prepare($qr,[],'Article',0);
    }*/

    public static function all(){
        $qr='select '.self::$table.'.id,title,content,category
        from '.self::$table.'
        left join cats
        on cats.id=catid
        order by '.self::$table.'.up desc';
        return self::query($qr);
    }

    /*public static function artByCat($catid){
        $qr='select posts.id,title,content,category
        from posts
        left join cats
        on cats.id=catid
        where catid=?';
        return Db::getDb()->prepare($qr,[$catid],'Article',0);
    }*/

    public static function artByCat($catid){
        $qr='select '.self::$table.'.id,title,content,category
        from '.self::$table.'
        left join cats
        on cats.id=catid
        where catid=?
        order by '.self::$table.'.up desc';
        return self::query($qr,[$catid]);
    }
    
    public static function categories(){
        return Db::getDb()->prepare('select id,title,content from posts where id=?',[1],'Article',0);
    }
    
    public static function post(int $id){
        return Db::getDb()->prepare('select id,title,content from posts where id=?',[$id],'Article',1);
    }

    public function getUrl(){
        return '/'.$this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getContent(){
        return $this->content;
    }
    public function getCategory(){
        return $this->category;
    }

}