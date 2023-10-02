<?php

namespace App;

use App\Controllers\ArticleController;
use App\Controllers\CategoryController;
use App\Controllers\UserController;
use App\Lib\Html;
use App\Lib\Php;
use App\Lib\Ses;

class RooterAjax
{
    //receive com=Rooter,home || Rooter,article + p1=1
    public function call(array $params): string
    {
        $com = Ses::get('com');
        [$class, $func] = Php::expl(',', $com);
        //$no = Secure::call($app, $mth);
        pr($params);
        echo $com;
        if (method_exists($class, $func)) {
            echo $class . '::' . $func;
            //use App\Lib\Html; //can't do that
            $app = new $class();
            //extract($params); //don't do that
            return $app->$func($params);
        }
        return '';
    }

}
