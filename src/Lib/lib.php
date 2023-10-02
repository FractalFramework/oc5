<?php
class lib
{

    static function pr(array $r): void
    {
        echo '<pre>' . print_r($r, true) . '</pre>';
    }
}
