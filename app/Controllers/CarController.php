<?php

namespace Controllers;

use Helper\Validation;
use Lib\JSON;
use Models\Car;
use Views\View;

class CarController
{
    const PARAM_PILOT = 2;
    const PARAM_MAKE  = 3;
    const PARAM_MODEL = 4;
    const PARAM_COLOR = 5;
    const PARAM_YEAR  = 6;

    public $dataCars;

    public function __construct()
    {
        $this->dataCars = JSON::getJson('dataCars');
    }

    public function newCar(array $input): void
    {
        Validation::paramsAreValid($input);
        Validation::yearIsValid($input);
        Validation::raceInProgress(JSON::getJson('dataRace')['Start']);
        Validation::pilotExists($input[self::PARAM_PILOT], $this->dataCars);

        $this->dataCars[] = [
            'Piloto' => $input[self::PARAM_PILOT],
            'Marca'  => $input[self::PARAM_MAKE],
            'Modelo' => $input[self::PARAM_MODEL],
            'Cor'    => $input[self::PARAM_COLOR],
            'Ano'    => $input[self::PARAM_YEAR]
        ];

        Car::setCars($this->dataCars);
        View::successMessageNewCar();
    }

    public function deleteCar(array $input): void
    {
        Validation::raceInProgress(JSON::getJson('dataRace')['Start']);
        Validation::pilotIsNull($input);

        foreach ($this->dataCars as $id => $dataCar) {
            if (self::existsPilot($input[self::PARAM_PILOT], $dataCar['Piloto'])) {
                unset($this->dataCars[$id]);

                Car::setCars($this->dataCars);
                View::successMessageDeleteCar();

                $this->ifExistsCarsThenSetPosition();

                return;
            }
        }
        View::errorMessageNotFoundCar();
    }

    public function setPosition(): void
    {
        Validation::raceInProgress(JSON::getJson('dataRace')['Start']);
        Validation::carsExists($this->dataCars);

        $position = 1;

        foreach ($this->dataCars as $id => $dataCar) {
            $this->dataCars[$id]['Posicao'] = $position;
            $position++;
        }

        $carsOrdered = RaceController::orderCars($this->dataCars);
        Car::setCars($carsOrdered);

        View::successMessageSetPosition();
    }

    public function showCars(): void
    {
        Validation::carsExists($this->dataCars);

        foreach ($this->dataCars as $car) {
            View::showCar($car);
        }
    }

    private static function existsPilot(string $pilot, string $data): bool
    {
        return $pilot == $data;
    }

    private function ifExistsCarsThenSetPosition(): void
    {
        if (count($this->dataCars) > 0) {
            $this->setPosition();
        }
    }
}
