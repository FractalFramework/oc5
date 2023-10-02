<?php

use App\Lib\Php;
use App\Lib\Ses;

function n()
{
    return "\n";
}
function br()
{
    return "<br />";
}

function pr(array $r): void
{
    echo '<pre>' . print_r($r, true) . '</pre>';
}

function cnfg(string $k)
{
    return Ses::$r['cnfg'][$k] ?? '';
}

function delbr($d, $o = '')
{
    return str_replace(['<br />', '<br/>', '<br>'], $o, $d ?? '');
}
function deln($d, $o = '')
{
    return str_replace("\n", $o, $d ?? '');
}
function delr($d, $o = '')
{
    return str_replace("\r", $o, $d ?? '');
}
function delt($d, $o = '')
{
    return str_replace("\t", $o, $d ?? '');
}
function delnl($d)
{
    return preg_replace('/(\n){2,}/', "\n\n", $d ?? '');
}
function delsp($d)
{
    return preg_replace('/( ){2,}/', ' ', $d ?? '');
}
