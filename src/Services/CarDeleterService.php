<?php

namespace Api\Services;

use Api\Controllers\CarController;
use Api\Enum\CommandInputEnum;
use Api\Enum\StatusEnum;
use Api\Messages\CarMessages;
use Api\Repository\CarRepository;
use Api\Repository\StatusRaceRepository;
use Api\Validations\CarValidator;
use Api\Validations\RaceValidator;
use Core\Command\CommandInput;
use Core\Command\CommandResponse;
use Core\Service\ServiceInterface;

final class CarDeleterService implements ServiceInterface
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
        $arguments = $commandInput->getArguments();
        $racingDriverName = $arguments[CommandInputEnum::RACING_DRIVER_NAME];

        $statusRace = (new StatusRaceRepository())->get();

        RaceValidator::runningIsInProgress($statusRace);
        CarValidator::racingDriverNameIsNull($racingDriverName);
        CarValidator::racingDriverNotExists($racingDriverName);

        $car = (new CarRepository())->findByName($racingDriverName);

        (new CarController())->delete($car->getId());

        $successMessage = CarMessages::successMessage_DeletedCar();
        return new CommandResponse(StatusEnum::OK, $successMessage);
    }
}
