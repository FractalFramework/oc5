<?php
function pr(array $r)
{
    echo '<pre>' . print_r($r, true) . '</pre>';
}
function atr(array $r)
{
    $ret = '';
    if ($r)
        foreach ($r as $k => $v)
            if ($v || $v == 0)
                $ret .= ' ' . $k . '="' . $v . '"';
    return $ret;
}
function tag(string $b, array $p, string $d)
{
    return '<' . $b . atr($p) . '>' . $d . '</' . $b . '>';
}

function lk(string $u, string $v = '', string $c = '', array $p = [])
{
    return tag('a', ['href' => $u, 'class' => $c] + $p, $v ? $v : domain($v));
}
function img(string $d, string $s = '', string $o = '')
{
    return taga('img', ['src' => $d, 'width' => $s, 'alt' => $o]);
}
function div(string $v, string $c = '', string $d = '', string $s = '')
{
    return tag('div', ['class' => $c, 'id' => $d, 'style' => $s], $v);
}
function span(string $v, string $c = '', string $d = '', string $s = '')
{
    return tag('span', ['class' => $c, 'id' => $d, 'style' => $s], $v);
}

//js

function atj($d, $j)
{
    return $d . '(' . implode_j($j) . ');';
}
function bj(string $j, string $v, string $c = '', array $p = [])
{
    if (cnfg('db'))
        $p += ['title' => $j];
    return tag('a', ['onclick' => 'bj(this)', 'data-bj' => $j, 'class' => $c] + $p, $v);
}
function bg(string $j, string $v, string $c = '', array $p = [])
{
    if (cnfg('db'))
        $p += ['title' => $j];
    return tag('a', ['onclick' => 'bg(this)', 'data-bj' => $j, 'class' => $c] + $p, $v);
}
function bh(string $h, string $v, string $c = '', array $p = [])
{
    return tag('a', ['href' => '/' . $h, 'onclick' => 'return bh(this)', 'class' => $c] + $p, $v);
}

//arrays
function expl(string $s, string $d, int $n = 2)
{
    $r = explode($s, $d);
    for ($i = 0; $i < $n; $i++)
        $rb[] = $r[$i] ?? '';
    return $rb;
}
function implode_j($d)
{
    $rb = [];
    if (!is_array($d))
        $r[] = $d;
    else
        $r = $d;
    foreach ($r as $k => $v)
        if ($v == 'this' or $v == 'event')
            $rb[] = $v;
        else
            $rb[] = '\'' . $v . '\'';
    if ($rb)
        return implode(',', $rb);
}

//vars
function gets()
{
    $r = $_GET;
    foreach ($r as $k => $v)
        ses::$r['get'][$k] = urldecode($v);
    return ses::$r['get'] ?? [];
}
function posts()
{
    $r = $_POST ?? [];
    foreach ($r as $k => $v)
        ses::$r['post'][$k] = delr($v);
    return ses::$r['post'] ?? [];
} #store
class ses
{
    static array $r = [];
    static array $er = [];
    static int $n = 0;
    static function k(string $k, $v)
    {
        return self::$r[$k] = $v;
    }
    static function r(string $k)
    {
        return self::$r[$k] ?? '';
    }
    static function z(string $k)
    {
        unset(self::$r[$k]);
    }
    static function err($v)
    {
        return self::$er[] = $v;
    }
    static function usr(string $k)
    {
        return self::$r['usr'][$k] ?? '';
    }
    static function cnfg(string $k)
    {
        return self::$r['cnfg'][$k] ?? '';
    }
    static function gets()
    {
        return self::$r['get'] ?? '';
    }
}
