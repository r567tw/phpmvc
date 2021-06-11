<?php
namespace app\core\exceptions;


class NotFoundException extends \Exception
{
    protected $message = '沒有該網頁！';
    protected $code  = 404;
}
