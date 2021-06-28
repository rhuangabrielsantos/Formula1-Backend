<?php

namespace Core\Command;

interface Command
{
    public function runCommand(CommandInput $commandInput): CommandResponse;
}