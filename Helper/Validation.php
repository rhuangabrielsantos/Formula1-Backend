<?php

namespace Helper;

use View\View;

class Validation
{
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

    public static function pilotIsNull(string $pilot): void
    {
        if (empty($pilot)) {
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
}
