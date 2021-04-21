<?php

namespace Api\Messages;

final class TerminalMessages
{
    public static function errorMessage(string $message): void
    {
        echo "\033[31m" . $message . "\033[39m" . PHP_EOL;
    }

    public static function successMessage(string $message): void
    {
        echo "\033[32m" . $message . "\033[39m" . PHP_EOL;
    }
}
