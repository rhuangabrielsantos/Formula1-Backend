<?php

namespace Api\Services;

use Api\Enum\StatusEnum;
use Api\Messages\RaceMessages;
use Api\Repository\CarRepository;
use Api\Repository\ReportRepository;
use Api\Repository\StatusRaceRepository;
use Api\Validations\CarValidator;
use Api\Validations\RaceValidator;
use Core\Command\CommandInput;
use Core\Command\CommandResponse;
use Core\Service\ServiceInterface;
use Exception;

final class RaceInitiatorService implements ServiceInterface
{
    /**
     * @param \Core\Command\CommandInput $commandInput
     * @return \Core\Command\CommandResponse
     */
    public function exec(CommandInput $commandInput): CommandResponse
    {
        try {
            $dataCars = (new CarRepository())->findAll();
            $statusRace = new StatusRaceRepository();

            RaceValidator::alreadyStarted($statusRace->get());

            CarValidator::thereAreCars($dataCars);
            CarValidator::existsMoreOneCar($dataCars);
            CarValidator::positionsAreSet($dataCars);

            $statusRace->setStartRace();

            (new ReportRepository())->deleteAll();

            return new CommandResponse(StatusEnum::OK, RaceMessages::successMessage_RaceStarted());
        } catch (Exception $exception) {

            return new CommandResponse(StatusEnum::ERROR, $exception->getMessage());
        }
    }
}
