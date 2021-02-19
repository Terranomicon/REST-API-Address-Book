<?php


class Logger
{
    static private $fplog;

    static public function start($flogname = 'log.txt')
    {
        self::$fplog = fopen($flogname, 'ab');
    }

    static public function stop()
    {
        fclose(self::$fplog);
    }

    static public function write($s, $usedate = true)
    {
        if ($usedate)
            $tim = '[' . date('Y-m-d H:i:s') . '] ';
        else
            $tim = '';
        fwrite(self::$fplog, $tim . $s . "\n");
    }
}

Logger::start();