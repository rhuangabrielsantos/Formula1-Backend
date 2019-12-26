<?php

namespace Helper;

use InvalidArgumentException;
use Views\View;

class Validation
{
    const PARAM_PILOT = 0;
    const PARAM_YEAR = 4;
    const NUMBER_PARAMS = 7;

    public static function raceAlreadyStarted(string $race): void
    {
        if ($race === 'on') {
            View::errorMessageStartAgain();
            exit;
        }
    }

    public static function existsMoreOneCar(array $cars): void
    {
        if (count($cars) === 1) {
            View::errorMessageOneCar();
            exit;
        }
    }

    public static function positionsAreSet(array $cars): void
    {
        foreach ($cars as $car) {
            if (empty($car['Posicao'])) {
                View::errorMessageNeedDefinePosition();
                exit;
            }
        }
    }

    public static function raceNotStarted(string $race): void
    {
        if ($race === 'off') {
            View::errorMessageNeedStart();
            exit;
        }
    }

    public static function carIsTheFirst(array $car): void
    {
        if ($car['Posicao'] === 1) {
            View::errorMessageOvertakingFirsPlace($car['Piloto']);
            exit;
        }
    }

    public static function existsReports($reports)
    {
        if (empty($reports)) {
            View::errorMessageEmptyReport();
            exit;
        }
    }

    public static function raceInProgress(string $race): void
    {
        if ($race === 'on') {
            View::errorMessageNewCarRaceStart();
            exit;
        }
    }

    public static function pilotExists(string $pilot, array $cars): void
    {
        foreach ($cars as $car) {
            if ($pilot === $car['Piloto']) {
                View::errorMessageNewCarExistPilot();
                exit;
            }
        }
    }

    public static function pilotIsNull(array $pilot): void
    {
        if (empty($pilot[self::PARAM_PILOT])) {
            View::errorMessageDeleteCar();
            exit;
        }
    }

    public static function carsExists(array $cars): void
    {
        if (empty($cars)) {
            View::errorMessageEmpty();
            exit;
        }
    }

    public static function yearIsValid($input): bool
    {
        if ($input == 0 || $input < 0) {
            View::errorMessageNotInteger();
            exit;
        }
        return true;
    }

    public static function paramsAreValid(array $input)
    {
        if (count($input) != self::NUMBER_PARAMS) {
            View::errorMessageNewCar();
            exit;
        }
    }
}
