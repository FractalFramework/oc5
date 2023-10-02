<?php

namespace App\Lib;

class Php
{
    //arrays
    static function expl(string $s, string $d, int $n = 2): array
    {
        $r = explode($s, $d);
        for ($i = 0; $i < $n; $i++)
            $rb[] = $r[$i] ?? '';
        return $rb;
    }
    static function implode_j(array $r): string
    {
        $rb = [];
        foreach ($r as $k => $v)
            if ($v == 'this' or $v == 'event')
                $rb[] = $v;
            else
                $rb[] = '\'' . $v . '\'';
        if ($rb)
            return implode(',', $rb);
    }

    //vars
    static function gets(): array
    {
        $r = $_GET;
        foreach ($r as $k => $v)
            ses::$r['get'][$k] = urldecode($v);
        return ses::$r['get'] ?? [];
    }
    static function posts(): array
    {
        $r = $_POST ?? [];
        foreach ($r as $k => $v)
            ses::$r['post'][$k] = delr($v);
        return ses::$r['post'] ?? [];
    }
}
