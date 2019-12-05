<?php

namespace Controllers;

use Helper\Validation;
use Models\Car;
use Views\View;

class CarController
{
    const PARAM_PILOT = 2;
    const PARAM_MAKE  = 3;
    const PARAM_MODEL = 4;
    const PARAM_COLOR = 5;
    const PARAM_YEAR  = 6;

    public function newCar(array $input, array $cars, string $statusRace): void
    {
        Validation::paramsAreValid($input);
        Validation::yearIsValid($input);
        Validation::raceInProgress($statusRace);
        Validation::pilotExists($input[self::PARAM_PILOT], $cars);

        $cars[] = [
            'Piloto' => $input[self::PARAM_PILOT],
            'Marca'  => $input[self::PARAM_MAKE],
            'Modelo' => $input[self::PARAM_MODEL],
            'Cor'    => $input[self::PARAM_COLOR],
            'Ano'    => $input[self::PARAM_YEAR]
        ];

        Car::setCars($cars);
        View::successMessageNewCar();
    }

    public function deleteCar(array $input, array $cars, string $statusRace): void
    {
        Validation::raceInProgress($statusRace);
        Validation::pilotIsNull($input);

        foreach ($cars as $id => $car) {
            if (self::existsPilot($input[self::PARAM_PILOT], $car['Piloto'])) {
                unset($cars[$id]);

                Car::setCars($cars);
                View::successMessageDeleteCar();

                $this->ifExistsCarsThenSetPosition($cars, $statusRace);

                return;
            }
        }
        View::errorMessageNotFoundCar();
    }

    public function setPosition(array $cars, string $statusRace): void
    {
        Validation::raceInProgress($statusRace);
        Validation::carsExists($cars);

        $position = 1;

        foreach ($cars as $id => $dataCar) {
            $cars[$id]['Posicao'] = $position;
            $position++;
        }

        $carsOrdered = RaceController::orderCars($cars);
        Car::setCars($carsOrdered);

        View::successMessageSetPosition();
    }

    public function showCars(array $cars): void
    {
        Validation::carsExists($cars);

        foreach ($cars as $car) {
            View::showCar($car);
        }
    }

    private static function existsPilot(string $pilot, string $data): bool
    {
        return $pilot == $data;
    }

    private function ifExistsCarsThenSetPosition(array $cars, string $statusRace): void
    {
        if (count($cars) > 0) {
            $this->setPosition($cars, $statusRace);
        }
    }
}
