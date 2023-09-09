<?php

//namespace Core;
//use \PDO;

class Connect{
	private $params=[];
    private $pdo;

    public function __construct(array $params=[]){
        if(!$params)$params=['host'=>'localhost', 'user'=>'root', 'pass'=>'dev', 'base'=>'oc5'];
        $this->params=$params;
    }

    private function getPDO(){
        if($this->pdo==null){
            $r=$this->params;
            ['host'=>$host,'user'=>$user,'pass'=>$pass,'base'=>$base]=$r;
            $dsn='mysql:host='.$host.';dbname='.$base.';charset=utf8';
            $pdo=new PDO($dsn,$user,$pass);
            $this->pdo=$pdo;
        }
        return $this->pdo;
    }

    public function query($stmt,$class){
        $req=$this->getPDO()->query($stmt);
        $datas=$req->fetchAll(PDO::FETCH_CLASS,$class);
        return $datas;
    }

public function prepare($stmt,$queries,$class,$one){
    $req=$this->getPDO()->prepare($stmt);
    $req->execute($queries);
    $req->setFetchMode(PDO::FETCH_CLASS,$class);
    if($one)$datas=$req->fetch();
    else $datas=$req->fetchAll();
    return $datas;
}

}