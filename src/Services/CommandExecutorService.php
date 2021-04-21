<?php

namespace Api\Services;

use Api\Commands\DefinePositionCommand;
use Api\Commands\DeleteCarCommand;
use Api\Commands\FinishRaceCommand;
use Api\Commands\NewCarCommand;
use Api\Commands\OvertakeCarCommand;
use Api\Commands\ShowCarsCommand;
use Api\Commands\ShowReportsCommand;
use Api\Commands\StartRaceCommand;
use Core\Command\Command;
use Core\Command\CommandInput;
use Core\Command\CommandResponse;

final class CommandExecutorService
{
    /**
     * @param \Core\Command\CommandInput $commandInput
     * @return \Core\Command\CommandResponse
     */
    public function run(CommandInput $commandInput): CommandResponse
    {
        $commands = self::createChainOfTheCommands();

        return $commands->runCommand($commandInput);
    }

    /**
     * @return \Core\Command\Command
     */
    private static function createChainOfTheCommands(): Command
    {
        return (new ShowCarsCommand())
            ->setNextCommand((new NewCarCommand())
                ->setNextCommand((new DefinePositionCommand())
                    ->setNextCommand((new DeleteCarCommand())
                        ->setNextCommand((new FinishRaceCommand())
                            ->setNextCommand((new OvertakeCarCommand())
                                ->setNextCommand((new ShowReportsCommand())
                                    ->setNextCommand((new StartRaceCommand()))))))));
    }
}
