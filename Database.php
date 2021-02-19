<?php

require_once 'Config.php';


class Database
{
    private static $connection = null;

    public static function getConnection()
    {
        if (!self::$connection) {
            $host = Config::getParam('host');
            $dbname = Config::getParam('dbname');
            $user = Config::getParam('user');
            $password = Config::getParam('password');
            self::$connection = pg_connect("host=$host dbname=$dbname user=$user password=$password");
        }
        return self::$connection;
    }
}