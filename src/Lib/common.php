<?php

declare(strict_types=1);

use App\Lib\Ses;

function n(): string
{
    return "\n";
}
function br(): string
{
    return "<br />";
}

#html

function atr(array $r): string
{
    $ret = '';
    if ($r) {
        foreach ($r as $k => $v) {
            if ($v || $v == 0) {
                $ret .= ' ' . $k . '="' . $v . '"';
            }
        }
    }
    return $ret;
}
function tag(string $b, array $p, string $d): string
{
    return '<' . $b . atr($p) . '>' . $d . '</' . $b . '>';
}

function lk(string $u, string $v = '', string $c = '', array $p = []): string
{
    return tag('a', ['href' => $u, 'class' => $c] + $p, $v ? $v : domain($v));
}
function img(string $d, string $s = '', string $o = ''): string
{
    return taga('img', ['src' => $d, 'width' => $s, 'alt' => $o]);
}
function div(string $v, string $c = '', string $d = '', string $s = ''): string
{
    return tag('div', ['class' => $c, 'id' => $d, 'style' => $s], $v);
}
function span(string $v, string $c = '', string $d = '', string $s = ''): string
{
    return tag('span', ['class' => $c, 'id' => $d, 'style' => $s], $v);
}

#js

function atj(string $d, array $r): string
{
    return $d . '(' . implode_j($r) . ');';
}
function ajaxCall(string $j, string $v, string $c = '', array $p = []): string
{
    if (cnfg('db')) {
        $p += ['title' => $j];
    }
    return tag('a', ['onclick' => 'bj(this)', 'data-bj' => $j, 'class' => $c] + $p, $v);
}
function ajaxToggle(string $j, string $v, string $c = '', array $p = []): string
{
    if (cnfg('db')) {
        $p += ['title' => $j];
    }
    return tag('a', ['onclick' => 'bg(this)', 'data-bj' => $j, 'class' => $c] + $p, $v);
}
function ajaxLink(string $h, string $v, string $c = '', array $p = []): string
{
    return tag('a', ['href' => '/' . $h, 'onclick' => 'return bh(this)', 'class' => $c] + $p, $v);
}

#str

function delbr(string $d, string $o = ''): string
{
    return str_replace(['<br />', '<br/>', '<br>'], $o, $d ?? '');
}
function deln(string $d, string $o = ''): string
{
    return str_replace("\n", $o, $d ?? '');
}
function delr(string $d, string $o = ''): string
{
    return str_replace("\r", $o, $d ?? '');
}
function delt(string $d, string $o = ''): string
{
    return str_replace("\t", $o, $d ?? '');
}
function delnl(string $d): string
{
    return preg_replace('/(\n){2,}/', "\n\n", $d ?? '');
}
function delsp(string $d): string
{
    return preg_replace('/( ){2,}/', ' ', $d ?? '');
}

#arrays

function expl(string $s, string $d, int $n = 2): array
{
    $r = explode($s, $d);
    for ($i = 0; $i < $n; $i++) {
        $rb[] = $r[$i] ?? '';
    }
    return $rb;
}
function implode_j(array $r): string
{
    $rb = [];
    $ret = '';
    foreach ($r as $k => $v) {
        if ($v == 'this' or $v == 'event') {
            $rb[] = $v;
        } else {
            $rb[] = '\'' . $v . '\'';
        }
    }
    if ($rb) {
        $ret = implode(',', $rb);
    }
    return $ret;
}


//gets

function gets(): array
{
    $r = $_GET;
    foreach ($r as $k => $v) {
        Ses::$r['get'][$k] = filter_input(INPUT_GET, $k);
        ;
    }
    return Ses::$r['get'] ?? [];
}
function posts(): array
{
    $r = $_POST ?? [];
    foreach ($r as $k => $v) {
        Ses::$r['post'][$k] = filter_input(INPUT_POST, $k);
    }
    return Ses::$r['post'] ?? [];
}

function cookie(string $d, string $v = null): string
{
    if (isset($v))
        setcookie($d, $v, time() + (86400 * 30));
    return $_COOKIE[$d] ?? '';
}
function cookiz(string $d): void
{
    unset($_COOKIE[$d]);
    setcookie($d, '', time() - 3600);
}
function ses(string $d, string $v = null): string
{
    if (isset($v)) //assign
        $_SESSION[$d] = $v;
    return $_SESSION[$d] ?? '';
}
function sesz(string $d): void
{
    if (isset($_SESSION[$d]))
        unset($_SESSION[$d]);
}
function sesx(string $d): bool
{
    return isset($_SESSION[$d]) ? true : false;
}
function sesmk(string $v, string $p = '', string $b = ''): mixed
{
    $rid = rid($v . $p);
    if (!isset($_SESSION[$rid]) or $b or ses('dev'))
        $_SESSION[$rid] = $v($p);
    return $_SESSION[$rid] ?? [];
}
function get($k, $v = '')
{
    return Ses::$r['get'][$k] ?? Ses::$r['get'][$k] = $v;
}
function post($k)
{
    return Ses::$r['post'][$k] ?? '';
}

#Service

//ses
function voc(string $d): string
{
    $r = sesmk('json::call', 'sys/voc', 0);
    return ucfirst($r[$d] ?? $d);
}
function ico(string $d): string
{
    $r = sesmk('json::call', 'sys/ico', 0);
    return span($r[$d] ?? '', 'ico');
}
function icovoc(string $d, string $b = '', string $c = ''): string
{
    return ico($d) . thin() . span(voc($b ? $b : $d), $c);
}

#params

function cnfg(string $k): string
{
    return Ses::$r['cnfg'][$k] ?? '';
}

#dev

function pr(array $r): void
{
    echo '<pre>' . print_r($r, true) . '</pre>';
}
function vd(object $r): void
{
    echo '<pre style="white-space: pre-line;">' . var_dump($r, true) . '</pre>';
}
