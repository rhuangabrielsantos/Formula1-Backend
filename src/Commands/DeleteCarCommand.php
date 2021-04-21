<?php

namespace Api\Commands;

use Api\Enum\StatusEnum;
use Api\Messages\CommandMessages;
use Api\Services\CarDeleterService;
use Core\Command\ChainBuilder;
use Core\Command\Command;
use Core\Command\CommandInput;
use Core\Command\CommandResponse;
use Exception;
use InvalidArgumentException;

final class DeleteCarCommand implements Command, ChainBuilder
{
    const COMMAND_NAME = 'excluirCarro';

    private ?Command $nextCommand;

    /**
     * @param Command|null $nextCommand
     * @return Command
     */
    public function setNextCommand(?Command $nextCommand): Command
    {
        $this->nextCommand = $nextCommand;

        return $this;
    }

    /**
     * @param CommandInput $commandInput
     * @return CommandResponse
     *
     * @throws Exception
     */
    public function runCommand(CommandInput $commandInput): CommandResponse
    {
        if (self::canHandleCommand($commandInput->getName())) {
            return (new CarDeleterService())->exec($commandInput);
        }

        if ($this->hasNextCommand()) {
            return $this->nextCommand->runCommand($commandInput);
        }

        throw new InvalidArgumentException(CommandMessages::errorMessage_CommandNotFound(), StatusEnum::INTERNAL_ERROR);
    }

    /**
     * @param string $commandName
     * @return bool
     */
    private static function canHandleCommand(string $commandName): bool
    {
        return $commandName === self::COMMAND_NAME;
    }

    /**
     * @return bool
     */
    private function hasNextCommand(): bool
    {
        return !empty($this->nextCommand);
    }
}
