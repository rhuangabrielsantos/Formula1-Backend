<?php

namespace Commands;

interface TerminalCommand
{
    public static function runCommand(array $arguments): array;
}