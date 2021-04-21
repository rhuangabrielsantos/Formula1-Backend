<?php

namespace Api\Services;

use Api\Controllers\RaceController;
use Api\Enum\StatusEnum;
use Api\Repository\StatusRaceRepository;
use Api\Validations\RaceValidator;
use Core\Command\CommandInput;
use Core\Command\CommandResponse;
use Core\Service\ServiceInterface;

final class RaceFinisherService implements ServiceInterface
{
    /**
     * @param \Core\Command\CommandInput $commandInput
     * @return \Core\Command\CommandResponse
     *
     * @throws \Exception
     */
    public function exec(CommandInput $commandInput): CommandResponse
    {
        $statusRace = new StatusRaceRepository();

        RaceValidator::runningIsNotInProgress($statusRace->get());

        $statusRace->setFinishRace();

        return new CommandResponse(StatusEnum::OK, RaceController::showPodium());
    }
}
