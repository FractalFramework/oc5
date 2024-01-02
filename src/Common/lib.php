<?php

declare(strict_types=1);

use App\Common\Ses;

function n(): string
{
    return "\n";
}
function br(): string
{
    return "<br />";
}

#html

function atr(array $array): string
{
    $ret = '';
    if ($array) {
        foreach ($array as $k => $value) {
            if ($value || $value == 0) {
                $ret .= ' ' . $k . '="' . $value . '"';
            }
        }
    }
    return $ret;
}
function tag(string $tag, array $params, string $data): string
{
    return '<' . $tag . atr($params) . '>' . $data . '</' . $tag . '>';
}

function lk(string $u, string $value = '', string $class = '', array $params = []): string
{
    return tag('a', ['href' => $u, 'class' => $class] + $params, $value ? $value : domain($value));
}
function img(string $data, string $s = '', string $option = ''): string
{
    return taga('img', ['src' => $data, 'width' => $s, 'alt' => $option]);
}
function div(string $value, string $class = '', string $data = '', string $s = ''): string
{
    return tag('div', ['class' => $class, 'id' => $data, 'style' => $s], $value);
}
function span(string $value, string $class = '', string $data = '', string $s = ''): string
{
    return tag('span', ['class' => $class, 'id' => $data, 'style' => $s], $value);
}

#js

function atj(string $attribute, array $propertiesArray): string
{
    return $attribute . '(' . implode_j($propertiesArray) . ');';
}
function ajaxCall(string $j, string $value, string $class = '', array $params = []): string
{
    if (cnfg('db')) {
        $params += ['title' => $j];
    }
    return tag('a', ['onclick' => 'bj(this)', 'data-bj' => $j, 'class' => $class] + $params, $value);
}
function ajaxToggle(string $j, string $value, string $class = '', array $params = []): string
{
    if (cnfg('db')) {
        $params += ['title' => $j];
    }
    return tag('a', ['onclick' => 'bg(this)', 'data-bj' => $j, 'class' => $class] + $params, $value);
}
function ajaxLink(string $h, string $value, string $class = '', array $params = []): string
{
    return tag('a', ['href' => '/' . $h, 'onclick' => 'return bh(this)', 'class' => $class] + $params, $value);
}

#str

function delbr(string $data, string $option = ''): string
{
    return str_replace(['<br />', '<br/>', '<br>'], $option, $data ?? '');
}
function deln(string $data, string $option = ''): string
{
    return str_replace("\n", $option, $data ?? '');
}
function delr(string $data, string $option = ''): string
{
    return str_replace("\r", $option, $data ?? '');
}
function delt(string $data, string $option = ''): string
{
    return str_replace("\t", $option, $data ?? '');
}
function delnl(string $data): string
{
    return preg_replace('/(\n){2,}/', "\n\n", $data ?? '');
}
function delsp(string $data): string
{
    return preg_replace('/( ){2,}/', ' ', $data ?? '');
}

#arrays

function expl(string $s, string $data, int $number = 2): array
{
    $array = explode($s, $data);
    for ($iteration = 0; $iteration < $number; $iteration++) {
        $rb[] = $array[$iteration] ?? '';
    }
    return $rb;
}
function implode_j(array $array): string
{
    $rb = [];
    $ret = '';
    foreach ($array as $value) {
        if ($value == 'this' or $value == 'event') {
            $rb[] = $value;
        } else {
            $rb[] = '\'' . $value . '\'';
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
    $array = $_GET;
    foreach ($array as $key => $value) {
        Ses::$array['get'][$key] = filter_input(INPUT_GET, $key);
    }
    return Ses::$array['get'] ?? [];
}
function posts(): array
{
    $array = $_POST ?? [];
    foreach ($array as $k => $value) {
        Ses::$array['post'][$k] = filter_input(INPUT_POST, $k);
    }
    return Ses::$array['post'] ?? [];
}

function cookie(string $key, string $value = null): string
{
    if (isset($value))
        setcookie($key, $value, time() + (86400 * 30));
    return $_COOKIE[$key] ?? '';
}
function cookiz(string $key): void
{
    unset($_COOKIE[$key]);
    setcookie($key, '', time() - 3600);
}
function sesvar(string $key): string
{
    return $_SESSION[$key] ?? '';
}

function sesint(string $key): int
{
    $value = $_SESSION[$key] ?? 0;
    return (int) $value;
}

function sesa(string $key, mixed $value = null): mixed //assign
{
    if (isset($value)) {
        $_SESSION[$key] = $value;
    }
    return sesvar($key);
}

function sesz(string $key): void
{
    if (isset($_SESSION[$key]))
        unset($_SESSION[$key]);
}
function sesx(string $key): bool
{
    return isset($_SESSION[$key]) ? true : false;
}
function sesmk(string $functionName, string $params = '', string $option = ''): mixed
{
    $rid = rid($functionName . $params);
    if (!isset($_SESSION[$rid]) or $option or sesvar('dev'))
        $_SESSION[$rid] = $functionName($params);
    return $_SESSION[$rid] ?? [];
}
function get($k, $value = '')
{
    return Ses::$array['get'][$k] ?? Ses::$array['get'][$k] = $value;
}
function post($k)
{
    return Ses::$array['post'][$k] ?? '';
}

#service

//ses
function voc(string $key): string
{
    $array = sesmk('json::call', 'sys/voc', 0);
    return ucfirst($array[$key] ?? $key);
}
function ico(string $key): string
{
    $array = sesmk('json::call', 'sys/ico', 0);
    return span($array[$key] ?? '', 'ico');
}
function icovoc(string $key, string $text = '', string $class = ''): string
{
    return ico($key) . thin() . span(voc($text ? $text : $key), $class);
}

#params

function cnfg(string $k): string
{
    return Ses::$array['cnfg'][$k] ?? '';
}

#files 
function scandir_b($d)
{
    $r = scandir($d);
    unset($r[0]);
    unset($r[1]);
    return $r;
}
function scandirs($d, $r = [])
{
    $dr = opendir($d);
    while ($f = readdir($dr))
        if ($f != '..' && $f != '.' && $f != '_notes') {
            $df = $d . '/' . $f;
            if (is_dir($df)) {
                $r[] = $df;
                $r += scandirs($df, $r);
            }
        }
    return $r;
}
function scanfiles($d, $r = [])
{
    $dr = opendir($d);
    while ($f = readdir($dr))
        if ($f != '..' && $f != '.' && $f != '_notes') {
            $df = $d . '/' . $f;
            if (is_dir($df))
                $r = scanfiles($df, $r);
            else
                $r[] = $f;
        }
    return $r;
}

function files_struct($dr)
{
    $r = scandirs($dr);
    foreach ($r as $k => $v) {
        $rb = scanfiles($v);
        $rt[] = '';
        $rt[] = '## ' . $v;
        //pr($rb);
        foreach ($rb as $ka => $va) {
            $rt[] = '- ' . $va;
        }
    }
    return join("\n", $rt);
}

#dev

function pr(array $array): void
{
    echo '<pre>' . print_r($array, true) . '</pre>';
}
function vd(object $array): void
{
    echo '<pre style="white-space: pre-line;">' . var_dump($array, true) . '</pre>';
}
