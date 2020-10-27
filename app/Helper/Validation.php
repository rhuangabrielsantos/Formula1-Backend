<?php

namespace Helper;

use Exception;
use Views\View;

class Validation
{
    const NUMBER_PARAMS = 5;

    public function raceAlreadyStarted(string $race): void
    {
        if ($race === 'on') {
            throw new Exception(View::errorMessageStartAgain());
        }
    }

    public function existsMoreOneCar(array $cars): void
    {
        if (count($cars) === 1) {
            throw new Exception(View::errorMessageOneCarImpossibleRace());
        }
    }

    public function positionsAreSet(array $cars): void
    {
        foreach ($cars as $car) {
            if (empty($car['Posicao'])) {
                throw new Exception(View::errorMessageNeedDefinePosition());
            }
        }
    }

    public function raceNotStarted(string $race): void
    {
        if ($race === 'off') {
            throw new Exception(View::errorMessageNeedStart());
        }
    }

    public function carIsTheFirst(array $car): void
    {
        if ($car['Posicao'] == 1) {
            throw new Exception(View::errorMessageOvertakingFirsPlace($car['Piloto']));
        }
    }

    public function existsReports($reports): void
    {
        if (empty($reports)) {
            throw new Exception(View::errorMessageEmptyReport());
        }
    }

    public function raceInProgress(string $race): void
    {
        if ($race === 'on') {
            throw new Exception(View::errorMessageRaceStarted());
        }
    }

    public function pilotExists(string $pilotName, array $dataCars): void
    {
        foreach ($dataCars as $dataCar) {
            if ($pilotName == $dataCar['Piloto']) {
                throw new Exception(View::errorMessageExistPilot());
            }
        }
    }

    public function pilotIsNull($pilotName): void
    {
        if (empty($pilotName)) {
            throw new Exception(View::errorMessageDeleteCarPilotNameIsNull());
        }
    }

    public function pilotIsNullOvertake($pilotName): void
    {
        if (empty($pilotName)) {
            throw new Exception(View::errorMessageOvertakePilotNameIsEmpty());
        }
    }

    public function carsExists(array $cars): void
    {
        if (empty($cars)) {
            throw new Exception(View::errorMessageDataCarsEmpty());
        }
    }

    public function yearIsValid($input): void
    {
        if ($input == 0 || $input < 0) {
            throw new Exception(View::errorMessageNotInteger());
        }
    }

    public function paramsAreValid(array $input)
    {
        if (count($input) != self::NUMBER_PARAMS) {
            throw new Exception(View::errorMessageInvalidCar());
        }

        foreach ($input as $item) {
            if (empty($item)) {
                throw new Exception(View::errorMessageInvalidCar());
            }
        }
    }

    public function terminalInputIsValid(array $arguments)
    {
        if (count($arguments) == 1) {
            throw new Exception(View::errorMessageCommandEmpty());
        }
    }

    public function pilotNameIsValid(string $pilotName, array $dataCars)
    {
        foreach ($dataCars as $dataCar) {
            if ($dataCar['Piloto'] == $pilotName) {
                return;
            }
        }

        throw new Exception(View::errorMessagePilotNameIsInvalid());

    }
}
