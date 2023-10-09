<?php
class css{
static $path='css/';

static function file($a){
return 'src/css/'.$a.'.css';}

static function trigger($a){
$f=self::file($a); $fb=json::file(self::$path.$a);
$d1=ftime($f); $d2=ftime($fb);
if($d2>$d1)return $f;}

static function save($a,$d){
if($f=self::trigger($a)){putfile($f,$d); err('saved: '.$f);}}

static function read($r){$rt=[];
foreach($r as $k=>$v)
if(is_array(current($v)))$rt[]=$k.'{'.self::read($v).'}';
else $rt[]=$k.'{'.implode_k($v,':','; ').'}';
return implode(n(),$rt);}

static function build($a){
$o=ses::cnfg('savecss');
$f=self::file($a); $d='';
if(!is_file($f) or $o){
	$r=json::call(self::$path.$a);
	if($r)$d=self::read($r);
	if($d)self::save($a,$d);}}
}
?>