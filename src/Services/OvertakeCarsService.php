<?php

namespace Api\Services;

use Api\Controllers\RaceController;
use Api\Entities\RacingDriver;
use Api\Enum\CommandInputEnum;
use Api\Enum\StatusEnum;
use Api\Messages\RaceMessages;
use Api\Repository\CarRepository;
use Api\Repository\StatusRaceRepository;
use Api\Validations\CarValidator;
use Api\Validations\RaceValidator;
use Core\Command\CommandInput;
use Core\Command\CommandResponse;
use Core\Service\ServiceInterface;

final class OvertakeCarsService implements ServiceInterface
{
    /**
     * @param \Core\Command\CommandInput $commandInput
     * @return \Core\Command\CommandResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Exception
     */
    public function exec(CommandInput $commandInput): CommandResponse
    {
        $carRepository = new CarRepository();

        $statusRace = (new StatusRaceRepository())->get();

        $racingDriverEntity = self::createRacingDriverEntity($commandInput->getArguments());

        RaceValidator::runningIsNotInProgress($statusRace);
        CarValidator::racingDriverNotExists($racingDriverEntity->getName());
        RaceValidator::carIsTheFirst($carRepository->findByName($racingDriverEntity->getName()));

        $nameRacingDriverWhoLost = (new RaceController())->overtake($racingDriverEntity->getName());

        $successMessage = RaceMessages::successMessage_Overtaking($racingDriverEntity->getName(), $nameRacingDriverWhoLost);
        return new CommandResponse($statusCode = StatusEnum::OK, $successMessage);
    }

    /**
     * @param array $arguments
     * @return \Api\Entities\RacingDriver
     */
    private static function createRacingDriverEntity(array $arguments): RacingDriver
    {
        return (new RacingDriver())->setName($arguments[CommandInputEnum::RACING_DRIVER_NAME]);
    }
}
