<?php

namespace Helper;

use Exception;
use Views\View;

class FormatEntry
{
    const COMMAND = 1;

    public function returnCommandNameFromTerminalInput(array $inputArguments): ?string
    {
        return $inputArguments[self::COMMAND];
    }

    public function returnArgumentsFromTerminalInput(array $arguments)
    {
        array_shift($arguments);
        array_shift($arguments);

        return $arguments;
    }
}