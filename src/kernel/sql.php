<?php
class sql{
static $qr;
static $sq;
static $r;

function __construct($r){if(!self::$qr){self::$r=$r; self::dbq();}}

static function dbq(){[$h,$n,$p,$b]=self::$r; 
$dsn='mysql:host='.$h.';dbname='.$b.';charset=utf8';
$ro=[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_PERSISTENT=>true,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,PDO::MYSQL_ATTR_INIT_COMMAND=>'set character set utf8mb4'];
self::$qr=new PDO($dsn,$n,$p,$ro);}

static function rq(){if(!self::$qr)self::dbq(); return self::$qr;}
static function qrr($r){return $r->fetchAll(PDO::FETCH_BOTH);}
static function qra($r){return $r->fetchAll(PDO::FETCH_ASSOC);}
static function qrw($r){return $r->fetchAll(PDO::FETCH_NUM);}
static function qr($sql,$z=''){$qr=self::rq(); if($z)err($sql);
try{return $qr->query($sql); echo $sql;}catch(Exception $e){err($e->getMessage());}}

static function format($r,$p){
$rt=[];  if($p=='v')$rt='';
foreach($r as $k=>$v)switch($p){
	case('a'):$rt=$v; break;//assoc
	case('w'):$rt=$v; break;//num
	case('r'):$rt=$v; break;//both
	case('v'):$rt=$v[0]; break;
	case('k'):$rt[$v[0]]=($rt[$v[0]]??0)+1; break;
	case('ra'):$rt[]=$v; break;//assoc
	case('rr'):$rt[]=$v; break;//both
	case('rn'):$rt[]=$v; break;//num
	case('rv'):$rt[]=$v[0]; break;//r
	case('kv'):$rt[$v[0]]=$v[1]??''; break;
	case('kk'):$rt[$v[0]][$v[1]]=($rt[$v[0]][$v[1]]??0)+1; break;
	case('vv'):$rt[]=[$v[0],$v[1]]; break;
	case('kr'):$rt[$v[0]][]=$v[1]; break;
	case('kkv'):$rt[$v[0]][$v[1]]=$v[2]; break;
	case('kkk'):$rt[$v[0]][$v[1]][$v[2]]+=1; break;
	case('kkkv'):$rt[$v[0]][$v[1]][$v[2]]=$v[3]; break;
	case('kvv'):$rt[$v[0]]=[$v[1],$v[2]]; break;
	case('kkr'):$rt[$v[0]][$v[1]][]=$v[2]; break;
	case('krr'):$rt[$v[0]][]=$v; break;
	case('kx'):$rt[$v[0]]=explode('/',$v[1]); break;
	case('index'):$rt[$v[0]]=$v; break;
	default:$rt[]=$v; break;}
return $rt;}

static function where($r){$rb=[]; $rt=[]; $w='';
if(is_numeric($r))$r=['id'=>$r]; $i=0;
if(is_string($r))return [[],$r];
foreach($r as $k=>$v){$i++;
	$c=substr($k,-1); $kb=substr($k,0,-1); $kc=$kb;//.$i
	if($k=='_order')$w=' order by '.$v;
	elseif($k=='_group')$w.=' group by '.$v;
	elseif($k=='_limit')$w.=' limit '.$v;
	elseif($c=='<'){$rb[]=$kb.'<:'.$kc; $rt[$kc]=$v;}
	elseif($c=='>'){$rb[]=$kb.'>:'.$kc; $rt[$kc]=$v;}
	elseif($c=='!'){$rb[]=$kb.'!=:'.$kc; $rt[$kc]=$v;}
	elseif($c=='%'){$rb[]=$kb.' like :'.$kc; $rt[$kc]='%'.$v.'%';}
	elseif($c=='-'){$rb[]='substring('.$kb.',1,1)!=:'.$kc.''; $rt[$kc]=$v;}
	elseif($c=='&'){$rb[]=$kb.' between :'.$kc.' and :'.$kc; $rt[$kc]=$v[0]; $rt[$kc]=$v[1];}
	elseif($c=='('){foreach($v as $ka=>$va)$rta['in'.$ka]=$va; $rt+=$rta;
		$rb[]=$kb.' in (:'.implode(',:',array_keys($rta)).')';}
	elseif($c==')'){foreach($v as $ka=>$va)$rta['nin'.$ka]=$va; $rt+=$rta;
		$rb[]=$kb.' not in (:'.implode(',:',array_keys($rta)).')';}
	else{$rb[]=$k.'=:'.$k; $rt[$k]=$v;}}
$q=implode(' and ',$rb); if($q)$q='where '.$q; if($w)$q.=$w;
return [$rt,$q];}

static function sqcl($d,$b){
if($d=='all' or !$d)$d=db::cols_s($b);
if($d=='allid' or !$d)$d='id,'.db::cols_s($b);
if($d=='full' or !$d)$d='id,'.db::cols_s($b).',up';
if(!$d)$d='*';
return $d;}

static function mkv($r){$rt=[]; foreach($r as $k=>$v)$rt[]=':'.$k; return implode(',',$rt);}
static function mkvk($r){$rt=[]; foreach($r as $k=>$v)$rt[]=$k.'=:'.$k; return implode(',',$rt);}
static function mkvr($r){$rt=[]; foreach($r as $k=>$v)$rt[]=$k.'="'.$v.'"'; return implode(',',$rt);}
static function mkq($r){[$r,$q]=self::where($r);//oldschool
foreach($r as $k=>$v){$vb='"'.$v.'"'; if(substr($v,0,9)=='password(' or $v=='null')$vb=$v;
$q=str_replace(':'.$k,$vb,$q);} return $q;}
static function mkvq($r){$q=[]; foreach($r as $k=>$v)$q[':'.$k]=$v; return $q;}
static function see($sql,$r){foreach($r as $k=>$v)$sql=str_replace(':'.$k,'"'.$v.'"',$sql); return $sql;}

static function fetch($stmt,$p){$rt=[];
if($p=='a' or $p=='ra')$rt=$stmt->fetchAll(\PDO::FETCH_ASSOC);
elseif($p=='r' or $p=='rr')$rt=$stmt->fetchAll(\PDO::FETCH_BOTH);
else $rt=$stmt->fetchAll(PDO::FETCH_NUM);
return $rt;}

static function bind($stmt,$r){
foreach($r as $k=>$v)$stmt->bindValue(':'.$k,$v,is_numeric($v)?PDO::PARAM_INT:PDO::PARAM_STR);}

static function prep($sql,$r,$z=''){
if($z)echo self::see($sql,$r); $qr=self::rq(); $stmt=$qr->prepare($sql); self::bind($stmt,$r);
try{$ok=$stmt->execute();}catch(Exception $e){err($e->getMessage());}
return $stmt;}

#
static function read($d,$b,$p,$q,$z=''){
[$r,$wh]=self::where($q); $ret=$p=='v'?'':[];
$sql='select '.self::sqcl($d,$b).' from '.$b.' '.$wh; self::$sq=$sql;
$stmt=self::prep($sql,$r,$z);
$rt=self::fetch($stmt,$p);
if($p)$ret=self::format($rt,$p);
return $ret;}

static function read2($d,$b,$p,$q,$z=''){$rt=[];
$qr=self::rq(); $q=self::mkq($q); $ret=$p=='v'?'':[];
$sql='select '.self::sqcl($d,$b).' from '.$b.' '.$q; self::$sq=$sql;
$stmt=$qr->query($sql);
$rt=self::fetch($stmt,$p);
if($p)$ret=self::format($rt,$p);
return $ret;}

static function alex($b,$r){
$ra=db::cols_k($b);
$rb=array_combine($ra,$r);
return self::read('id',$b,'v',$rb);}

static function combine($b,$r){
$ra=db::cols_k($b);
//$ra=self::cols($b);//will fail cause db src
return array_combine($ra,$r);}

static function integrity($b,$r){
$ra=db::cols_r($b);
foreach($ra as $k=>$v)switch($v){
	case('int'):!is_numeric($r[$k])?$r[$k]=0:'';}
return $r;}

static function complete($r){
$r=['id'=>NULL]+$r+['up'=>sqldate()];
//array_unshift($r,NULL); array_push($r,sqldate());
return $r;}

static function sav($b,$q,$z=''){
$ex=self::alex($b,$q); if($ex)return false;
$r=self::combine($b,$q);
$r=self::integrity($b,$r);
$q=self::complete($r);
$sql='insert into '.$b.' value ('.self::mkv($q).')';
$stmt=self::prep($sql,$q,$z);
return self::$qr->lastInsertId();}

static function sav2($b,$q,$z=''){
$sk=self::mkv($q); $sq=self::mkvq($q); //eco($q);
$sql='insert into '.$b.' value ('.$sk.')';
$stmt=self::prep($sql,$q,$z);
return self::$qr->lastInsertId();}

static function upd($b,$r,$q,$z=''){
$vals=self::mkvk($r); [$ra,$wh]=self::where($q);
$sql='update '.$b.' set '.$vals.' '.$wh;
$stmt=self::prep($sql,$ra+$r,$z);
return $stmt?1:0;}

static function inner($d,$b1,$b2,$k2,$p,$q,$z=''){
if($d==$k2)$d=$b2.'.'.$d; [$ra,$wh]=self::where($q); $rt=[]; $ret=$p=='v'?'':[];
$sql='select '.self::sqcl($d,$b2).' from '.$b1.' b1 inner join '.$b2.' b2 on b1.id=b2.'.$k2.' '.$wh;
//$stmt=self::prep($sql,$ra,$z);
$sql=self::see($sql,$ra); $stmt=self::qr($sql,$z); //pr($sql); //echo $sql.br();
if($stmt)$rt=self::fetch($stmt,$p);
if($rt)$ret=self::format($rt,$p);
return $ret;}

static function call($sql,$p,$z=''){
$stmt=self::qr($sql,$z);
$rt=self::fetch($stmt,$p);
return self::format($rt,$p);}

static function call2($sql,$p){
$qr=self::rq(); $stmt=$qr->query($sql);
return self::fetch($stmt,$p);}

static function com($sql){
return self::rq()->query($sql);}

static function cols($b,$n=''){if($n)$b=cnfg('db').'.'.$b;
$sql='select column_name,data_type from information_schema.columns where table_name="'.$b.'"';
return self::call($sql,'kv');}
static function drop($b){self::qr('drop table '.$b);}
static function trunc($b){self::qr('truncate table '.$b);}
static function setinc($b,$n){self::qr('alter table '.$b.' auto_increment='.$n);}
static function unikey($b,$d){self::qr('alter table '.$b.' add unique key '.$d.' ('.$d.')');}
static function show($b){self::call('show tables like "'.$b.'"','rv',1);}
static function ex($b){$rq=self::read('id',$b,'v',[]); return $rq?1:0;}
static function backup($b,$d=''){$bb='z_'.$b.'_'.$d;
if(self::ex($bb))self::drop($bb);
self::qr('create table '.$bb.' like '.$b);
//self::qr('alter table '.$bb.' add primary key (id)');
self::qr('insert into '.$bb.' select * from '.$b);
return $bb;}
}
?>