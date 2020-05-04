<?php

namespace Controllers;

use Exception;
use Helper\Validation;
use Views\View;

class CarController
{
    const PARAM_PILOT = 0;
    const PARAM_MAKE = 1;
    const PARAM_MODEL = 2;
    const PARAM_COLOR = 3;
    const PARAM_YEAR = 4;

    private $validation;

    public function __construct()
    {
        $this->validation = new Validation();
    }

    public function newCar(array $newCar, array $dataCars): array
    {
        $dataCars[] = [
            'Piloto' => $newCar[self::PARAM_PILOT],
            'Marca' => $newCar[self::PARAM_MAKE],
            'Modelo' => $newCar[self::PARAM_MODEL],
            'Cor' => $newCar[self::PARAM_COLOR],
            'Ano' => $newCar[self::PARAM_YEAR]
        ];

        return $dataCars;
    }

    public function deleteCar(?string $pilotName, array $cars): array
    {
        foreach ($cars as $id => $car) {
            if (self::existsPilot($pilotName, $car['Piloto'])) {
                unset($cars[$id]);

                return $this->ifExistsCarsThenSetPosition($cars);
            }
        }

        throw new Exception(View::errorMessageNotFoundCar());
    }

    public function setPosition(array $cars): array
    {
        $position = 1;

        foreach ($cars as $id => $dataCar) {
            $cars[$id]['Posicao'] = $position;
            $position++;
        }

        return RaceController::orderCars($cars);
    }

    public function showCars(array $cars): void
    {
        foreach ($cars as $car) {
            View::showCar($car);
        }
    }

    private static function existsPilot(string $pilot, string $data): bool
    {
        return $pilot == $data;
    }

    private function ifExistsCarsThenSetPosition(array $cars): array
    {
        $returnedCars = [];

        if (count($cars) > 0) {
            $returnedCars = $this->setPosition($cars);
        }

        return $returnedCars;
    }
}
