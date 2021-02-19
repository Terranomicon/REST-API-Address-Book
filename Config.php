<?php

declare(strict_types=1);

class Config
{
    public static function getParam(string $name): string
    {
        $config = parse_ini_file('config.ini');
        return $config[$name];
    }
}