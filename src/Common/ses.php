<?php

declare(strict_types=1);

namespace App\Common;

class Ses
{
    public static array $array = [];
    public static array $error = [];
    public static int $number = 0;
    public static function append(string $key, string $value): string
    {
        return self::$array[$key] = $value;
    }
    public static function row(string $key): array
    {
        return self::$array[$key] ?? '';
    }
    public static function erase(string $key): void
    {
        unset(self::$array[$key]);
    }
    public static function error($value): string
    {
        return self::$error[] = $value;
    }
    public static function cnfg(string $key): string
    {
        return self::$array['cnfg'][$key] ?? '';
    }
    public static function gets(): array
    {
        return self::$array['get'] ?? '';
    }
    public static function get(string $key): string
    {
        return self::$array['get'][$key] ?? '';
    }
}
