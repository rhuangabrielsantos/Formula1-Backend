<?php

namespace Controllers;

use Helper\Validation;
use Models\Car;
use Views\View;

class CarController
{
    const PARAM_PILOT = 0;
    const PARAM_MAKE  = 1;
    const PARAM_MODEL = 2;
    const PARAM_COLOR = 3;
    const PARAM_YEAR  = 4;

    public function newCar(array $newCar, array $dataCars, string $statusRace): array
    {
        Validation::raceInProgress($statusRace);
        Validation::pilotExists($newCar[self::PARAM_PILOT], $dataCars);

        $dataCars[] = [
            'Piloto' => $newCar[self::PARAM_PILOT],
            'Marca'  => $newCar[self::PARAM_MAKE],
            'Modelo' => $newCar[self::PARAM_MODEL],
            'Cor'    => $newCar[self::PARAM_COLOR],
            'Ano'    => $newCar[self::PARAM_YEAR]
        ];

        return $dataCars;
    }

    public function deleteCar(array $input, array $cars, string $statusRace): array
    {
        Validation::raceInProgress($statusRace);
        Validation::pilotIsNull($input);

        foreach ($cars as $id => $car) {
            if (self::existsPilot($input[self::PARAM_PILOT], $car['Piloto'])) {
                unset($cars[$id]);

                return $this->ifExistsCarsThenSetPosition($cars, $statusRace);
            }
        }
        View::errorMessageNotFoundCar();
        return [];
    }

    public function setPosition(array $cars, string $statusRace): array
    {
        Validation::raceInProgress($statusRace);
        Validation::carsExists($cars);

        $position = 1;

        foreach ($cars as $id => $dataCar) {
            $cars[$id]['Posicao'] = $position;
            $position++;
        }

        return RaceController::orderCars($cars);
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

    private function ifExistsCarsThenSetPosition(array $cars, string $statusRace): array
    {
        $returnedCars = [];

        if (count($cars) > 0) {
            $returnedCars = $this->setPosition($cars, $statusRace);
        }

        return $returnedCars;
    }
}
