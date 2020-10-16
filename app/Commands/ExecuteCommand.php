<?php

namespace Commands;

use Controllers\CommandController;
use Helper\Status;
use Views\View;

class ExecuteCommand
{
    public function run(string $endPoint, array $arguments): array
    {
        $registeredCommands = (new CommandController)->getRegisteredCommands();

        $classInstance = $registeredCommands[$endPoint];

        if ($classInstance) {
            return $classInstance::runCommand($arguments);
        }

        return [
            'status' => Status::ERROR,
            'message' => (new View())->errorMessageCommands()
        ];
    }
}