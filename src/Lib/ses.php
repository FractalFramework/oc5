<?php
class ses
{
    static array $r = [];
    static array $er = [];
    static int $n = 0;
    static function append(string $k, string $v): string
    {
        return self::$r[$k] = $v;
    }
    static function row(string $k): array
    {
        return self::$r[$k] ?? '';
    }
    static function erase(string $k): void
    {
        unset(self::$r[$k]);
    }
    static function error($v): string
    {
        return self::$er[] = $v;
    }
    static function cnfg(string $k): string
    {
        return self::$r['cnfg'][$k] ?? '';
    }
    static function gets(): array
    {
        return self::$r['get'] ?? '';
    }
    static function get(string $k): string
    {
        return self::$r['get'][$k] ?? '';
    }
}
