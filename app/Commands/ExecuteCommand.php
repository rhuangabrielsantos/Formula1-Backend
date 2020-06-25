<?php

namespace Commands;

use Controllers\CommandController;
use Views\View;

class ExecuteCommand
{
    public function run(string $endPoint, array $arguments)
    {
        $registeredCommands = (new CommandController)->getRegisteredCommands($arguments);

        foreach ($registeredCommands as $command => $classInstance) {
            if ($endPoint == $command) {
                $classInstance->runCommand();
                return;
            }
        }

        echo (new View())->errorMessageCommands();
    }
}