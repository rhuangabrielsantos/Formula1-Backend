<?php

namespace Api\Builders;

use Api\Enum\CommandEnum;
use Api\Enum\StatusEnum;
use Api\Messages\CommandMessages;
use Core\Builder\CommandBuilder;
use Core\Command\CommandInput;
use Exception;
use InvalidArgumentException;

final class TerminalCommandBuilder implements CommandBuilder
{
    private string $commandName;
    private array $commandArguments;

    /**
     * @param array $inputData
     * @throws Exception
     */
    public function __construct(array $inputData)
    {
        if (count($inputData) == 1) {
            throw new Exception(CommandMessages::errorMessageCommandEmpty());
        }

        $this->commandName = $this->getCommandNameByInputDateOrCry($inputData);
        $this->commandArguments = $this->getCommandArgumentsByInputData($inputData);
    }

    /**
     * @param array $inputData
     * @return string
     */
    private function getCommandNameByInputDateOrCry(array $inputData): string
    {
        $commandName = $inputData[CommandEnum::NAME];

        if (!$commandName) {
            throw new InvalidArgumentException('Por favor, informe um comando.', StatusEnum::BAD_REQUEST);
        }

        return $commandName;
    }

    /**
     * @param array $inputData
     * @return array
     */
    private function getCommandArgumentsByInputData(array $inputData): array
    {
        array_shift($inputData);
        array_shift($inputData);

        return $inputData;
    }

    /**
     * @return \Core\Command\CommandInput
     */
    public function getCommand(): CommandInput
    {
        return new CommandInput($this->commandName, $this->commandArguments);
    }
}
