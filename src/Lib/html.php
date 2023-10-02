<?php

namespace App\Lib;

use App\Lib\Php;

class Html
{
    static function atr(array $r): string
    {
        $ret = '';
        if ($r)
            foreach ($r as $k => $v)
                if ($v || $v == 0)
                    $ret .= ' ' . $k . '="' . $v . '"';
        return $ret;
    }
    static function tag(string $b, array $p, string $d): string
    {
        return '<' . $b . self::atr($p) . '>' . $d . '</' . $b . '>';
    }

    static function lk(string $u, string $v = '', string $c = '', array $p = []): string
    {
        return self::tag('a', ['href' => $u, 'class' => $c] + $p, $v ? $v : domain($v));
    }
    static function img(string $d, string $s = '', string $o = ''): string
    {
        return taga('img', ['src' => $d, 'width' => $s, 'alt' => $o]);
    }
    static function div(string $v, string $c = '', string $d = '', string $s = ''): string
    {
        return self::tag('div', ['class' => $c, 'id' => $d, 'style' => $s], $v);
    }
    static function span(string $v, string $c = '', string $d = '', string $s = ''): string
    {
        return self::tag('span', ['class' => $c, 'id' => $d, 'style' => $s], $v);
    }

    #js

    static function atj(string $d, string $j): string
    {
        return $d . '(' . Php::implode_j($j) . ');';
    }
    static function ajax(string $j, string $v, string $c = '', array $p = []): string
    {
        if (cnfg('db'))
            $p += ['title' => $j];
        return self::tag('a', ['onclick' => 'bj(this)', 'data-bj' => $j, 'class' => $c] + $p, $v);
    }
    static function ajaxToggle(string $j, string $v, string $c = '', array $p = []): string
    {
        if (cnfg('db'))
            $p += ['title' => $j];
        return self::tag('a', ['onclick' => 'bg(this)', 'data-bj' => $j, 'class' => $c] + $p, $v);
    }
    static function ajaxLink(string $h, string $v, string $c = '', array $p = []): string
    {
        return self::tag('a', ['href' => '/' . $h, 'onclick' => 'return bh(this)', 'class' => $c] + $p, $v);
    }

}
