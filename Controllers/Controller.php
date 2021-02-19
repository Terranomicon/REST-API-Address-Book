<?php


abstract class Controller
{
    public function response($data, $code)
    {
        http_response_code($code);
        echo json_encode($data);
        exit;
    }
}