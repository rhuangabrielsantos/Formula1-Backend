<?php

namespace Api\Services;

use Api\Controllers\RaceController;
use Api\Enum\StatusEnum;
use Api\Repository\StatusRaceRepository;
use Api\Validations\RaceValidator;
use Core\Command\CommandInput;
use Core\Command\CommandResponse;
use Core\Service\ServiceInterface;
use Exception;

final class RaceFinisherService implements ServiceInterface
{
    /**
     * @param \Core\Command\CommandInput $commandInput
     * @return \Core\Command\CommandResponse
     */
    public function exec(CommandInput $commandInput): CommandResponse
    {
        try {
            $statusRace = new StatusRaceRepository();

            RaceValidator::runningIsNotInProgress($statusRace->get());

            $statusRace->setFinishRace();

            return new CommandResponse(StatusEnum::OK, RaceController::showPodium());
        } catch (Exception $exception) {

            return new CommandResponse(StatusEnum::ERROR, $exception->getMessage());
        }
    }
}
