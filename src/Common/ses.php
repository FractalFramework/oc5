<?php

declare(strict_types=1);

namespace App\Common;

class Ses
{
    public static array $r = [];
    public static array $er = [];
    public static int $n = 0;
    public static function append(string $k, string $v): string
    {
        return self::$r[$k] = $v;
    }
    public static function row(string $k): array
    {
        return self::$r[$k] ?? '';
    }
    public static function erase(string $k): void
    {
        unset(self::$r[$k]);
    }
    public static function error($v): string
    {
        return self::$er[] = $v;
    }
    public static function cnfg(string $k): string
    {
        return self::$r['cnfg'][$k] ?? '';
    }
    public static function gets(): array
    {
        return self::$r['get'] ?? '';
    }
    public static function get(string $k): string
    {
        return self::$r['get'][$k] ?? '';
    }
}
