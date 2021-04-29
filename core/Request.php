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

    public function getBody()
    {
        $body = [];
        if ($this->getMethod() === 'GET')
        {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET,$key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->getMethod() === 'POST') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }


        return $body;
    }
}
