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
use Exception;

final class CarMakerService implements ServiceInterface
{
    /**
     * @param \Core\Command\CommandInput $commandInput
     * @return \Core\Command\CommandResponse
     *
     * @throws Exception
     */
    public function exec(CommandInput $commandInput): CommandResponse
    {
        $racingDriver = $commandInput->getArguments()[CommandInputEnum::RACING_DRIVER_NAME];

        $dataCars = (new CarRepository())->findAll();
        $statusRace = (new StatusRaceRepository())->get();

        RaceValidator::runningIsInProgress($statusRace);
        CarValidator::racingDriverExists($dataCars, $racingDriver);

        (new CarController())->create($commandInput->getArguments());

        return new CommandResponse(StatusEnum::CREATED, CarMessages::successMessage_CreatedCar());
    }
}
