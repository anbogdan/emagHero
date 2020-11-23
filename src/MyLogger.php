<?php

namespace EmagHero;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

class MyLogger extends Logger
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance == null)
        {
            $output = "[%datetime%] %message%\n";
            $formatter = new LineFormatter($output);
            $streamHandler = new StreamHandler('php://stdout');
            $streamHandler->setFormatter($formatter);
            self::$instance = new MyLogger("BattleInfo");
            self::$instance->pushHandler($streamHandler);
        }
        return self::$instance;
    }
}
