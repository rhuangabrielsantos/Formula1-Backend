<?php

namespace Api\Validations;

use Api\Entities\Car;
use Api\Enum\StatusEnum;
use Api\Messages\RaceMessages;
use Exception;

final class RaceValidator
{
    /**
     * @param string $statusRace
     *
     * @throws Exception
     */
    public static function runningIsInProgress(string $statusRace): void
    {
        if ($statusRace === 'on') {
            throw new Exception(RaceMessages::errorMessage_CannotCreateOrDeleteCarsRaceInProgress(), StatusEnum::INTERNAL_ERROR);
        }
    }

    /**
     * @param string $statusRace
     *
     * @throws Exception
     */
    public static function runningIsNotInProgress(string $statusRace): void
    {
        if ($statusRace === 'off') {
            throw new Exception(RaceMessages::errorMessage_NeedStartRace());
        }
    }

    /**
     * @param Car $car
     *
     * @throws Exception
     */
    public static function carIsTheFirst(Car $car)
    {
        if ($car->getPosition() === 1) {
            throw new Exception(RaceMessages::errorMessage_OvertakingFirsPlace($car->getRacingDriver()));
        }
    }

    /**
     * @param string $statusRace
     *
     * @throws Exception
     */
    public static function alreadyStarted(string $statusRace)
    {
        if ($statusRace === 'on') {
            throw new Exception(RaceMessages::errorMessage_RaceInProgress());
        }
    }
}
