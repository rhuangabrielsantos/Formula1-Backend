<?php

namespace Api\Commands;

use Api\Enum\StatusEnum;
use Api\Messages\CommandMessages;
use Api\Services\PositionDefinerService;
use Core\Command\ChainBuilder;
use Core\Command\Command;
use Core\Command\CommandInput;
use Core\Command\CommandResponse;
use Doctrine\ORM\ORMException;
use InvalidArgumentException;

final class DefinePositionCommand implements Command, ChainBuilder
{
    const COMMAND_NAME = 'definirPosicoes';

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
     * @param CommandInput $commandInput
     * @return CommandResponse
     *
     * @throws ORMException
     */
    public function runCommand(CommandInput $commandInput): CommandResponse
    {
        if (self::canHandleCommand($commandInput->getName())) {
            return (new PositionDefinerService())->exec($commandInput);
        }

        if (self::hasNextCommand()) {
            return $this->nextCommand->runCommand($commandInput);
        }

        throw new InvalidArgumentException(CommandMessages::errorMessage_CommandNotFound(), StatusEnum::ERROR);
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
