<?php

namespace Helper;

use Views\View;

class Validation
{
    const PARAM_PILOT = 0;
    const PARAM_YEAR = 4;
    const NUMBER_PARAMS = 7;

    public function raceAlreadyStarted(string $race): void
    {
        if ($race === 'on') {
            View::errorMessageStartAgain();
            exit;
        }
    }

    public function existsMoreOneCar(array $cars): void
    {
        if (count($cars) === 1) {
            View::errorMessageOneCar();
            exit;
        }
    }

    public function positionsAreSet(array $cars): void
    {
        foreach ($cars as $car) {
            if (empty($car['Posicao'])) {
                View::errorMessageNeedDefinePosition();
                exit;
            }
        }
    }

    public function raceNotStarted(string $race): void
    {
        if ($race === 'off') {
            View::errorMessageNeedStart();
            exit;
        }
    }

    public function carIsTheFirst(array $car): void
    {
        if ($car['Posicao'] === 1) {
            View::errorMessageOvertakingFirsPlace($car['Piloto']);
            exit;
        }
    }

    public function existsReports($reports)
    {
        if (empty($reports)) {
            View::errorMessageEmptyReport();
            exit;
        }
    }

    public function raceInProgress(string $race): void
    {
        if ($race === 'on') {
            View::errorMessageNewCarRaceStart();
            exit;
        }
    }

    public function pilotExists(string $pilot, array $cars): void
    {
        foreach ($cars as $car) {
            if ($pilot === $car['Piloto']) {
                View::errorMessageNewCarExistPilot();
                exit;
            }
        }
    }

    public function pilotIsNull($pilotName): void
    {
        if (empty($pilotName)) {
            View::errorMessageDeleteCar();
            exit;
        }
    }

    public function carsExists(array $cars): void
    {
        if (empty($cars)) {
            View::errorMessageEmpty();
            exit;
        }
    }

    public function yearIsValid($input): bool
    {
        if ($input == 0 || $input < 0) {
            View::errorMessageNotInteger();
            exit;
        }
        return true;
    }

    public function paramsAreValid(array $input)
    {
        if (count($input) != self::NUMBER_PARAMS) {
            View::errorMessageNewCar();
            exit;
        }
    }
}
