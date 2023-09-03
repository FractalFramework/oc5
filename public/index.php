<?php
$g = gets();
get('a', 'home'); //default app
$g = ses::gets();

$ret = main::call($g);

//dev
if (ses('dev')) echo div(rdiv(ses::$er), 'small') . n();

echo tag('body', [], $ret);
//echo '</html>';
