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
        $statusRace = (new StatusRaceRepository())->get();

        RaceValidator::runningIsInProgress($statusRace);

        $formattedArguments = self::prepareArguments($commandInput->getArguments());

        (new CarController())->create($formattedArguments);

        return new CommandResponse(StatusEnum::CREATED, CarMessages::successMessage_CreatedCar());
    }

    /**
     * @param array $arguments
     * @return array
     */
    private static function prepareArguments(array $arguments): array
    {
        return [
            'racing_driver' => $arguments[CommandInputEnum::RACING_DRIVER_NAME],
            'brand' => $arguments[CommandInputEnum::CAR_BRAND],
            'model' => $arguments[CommandInputEnum::CAR_MODEL],
            'color' => $arguments[CommandInputEnum::CAR_COLOR],
            'year' => $arguments[CommandInputEnum::CAR_YEAR]
        ];
    }
}
