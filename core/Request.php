<?php

namespace app\core;

class Request
{
    public function getPath()
    {
        $path = $_SERVER["REQUEST_URI"] ?? '/';
        $postion = strpos($path, '?');
        if ($postion === false){
            return $path;
        }
        return substr($path,0,$postion);
    }

    public function getMethod()
    {
        return strtoupper($_SERVER["REQUEST_METHOD"]);
    }
}
