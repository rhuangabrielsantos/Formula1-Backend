<?php

namespace Api\Commands;

use Api\Enum\StatusEnum;
use Api\Messages\CommandMessages;
use Api\Services\ShowReportsService;
use Core\Command\ChainBuilder;
use Core\Command\Command;
use Core\Command\CommandInput;
use Core\Command\CommandResponse;
use InvalidArgumentException;

final class ShowReportsCommand implements Command, ChainBuilder
{
    const COMMAND_NAME = 'relatorio';

    private ?Command $nextCommand;

    /**
     * @param \Core\Command\Command|null $nextCommand
     * @return \Core\Command\Command
     */
    public function setNextCommand(?Command $nextCommand): Command
    {
        $this->nextCommand = $nextCommand;

        return $this;
    }

    /**
     * @param \Core\Command\CommandInput $commandInput
     * @return \Core\Command\CommandResponse
     */
    public function runCommand(CommandInput $commandInput): CommandResponse
    {
        if (self::canHandleCommand($commandInput->getName())) {
            return (new ShowReportsService())->exec($commandInput);
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
