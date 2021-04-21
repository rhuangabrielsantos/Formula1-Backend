<?php

namespace Api\Services;

use Api\Controllers\CarController;
use Api\Enum\StatusEnum;
use Api\Messages\CarMessages;
use Api\Repository\CarRepository;
use Api\Repository\StatusRaceRepository;
use Api\Validations\CarValidator;
use Api\Validations\RaceValidator;
use Core\Command\CommandInput;
use Core\Command\CommandResponse;
use Core\Service\ServiceInterface;
use Doctrine\ORM\ORMException;
use Exception;

final class PositionDefinerService implements ServiceInterface
{
    /**
     * @param \Core\Command\CommandInput $commandInput
     * @return \Core\Command\CommandResponse
     *
     * @throws ORMException
     * @throws Exception
     */
    public function exec(CommandInput $commandInput): CommandResponse
    {
        $statusRace = (new StatusRaceRepository())->get();
        $dataCars = (new CarRepository())->findAll();

        RaceValidator::runningIsInProgress($statusRace);
        CarValidator::thereAreCars($dataCars);

        (new CarController())->setPosition($dataCars);

        $successMessage = CarMessages::successMessage_DefinedPosition();
        return new CommandResponse($statusCode = StatusEnum::OK, $successMessage);
    }
}
