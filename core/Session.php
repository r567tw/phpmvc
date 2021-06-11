<?php

namespace app\core;


class Session
{
    protected const FLASH_KEY = 'flash_messages';

    public function __construct()
    {
        session_start();
        $messages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($messages as &$value) {
            $value['removed'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $messages;
    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'removed' => false,
            'message' => $message
        ];
    }

    public function getFlash($key)
    {
        return $_SESSION['flash_messages'][$key]['message'] ?? false;
    }

    public function __destruct()
    {
        $messages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($messages as $key => &$value) {
            if ($value['removed']){
                unset($messages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $messages;
    }
}
