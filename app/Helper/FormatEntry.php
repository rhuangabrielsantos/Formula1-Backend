<?php

namespace Helper;

class FormatEntry
{
    const COMMAND = 1;

    public function returnCommandNameFromTerminalInput(array $arguments)
    {
        return $arguments[self::COMMAND];
    }

    public function returnArgumentsFromTerminalInput(array $arguments)
    {
        array_shift($arguments);
        array_shift($arguments);

        return $arguments;
    }
}