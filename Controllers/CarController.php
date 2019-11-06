<?php

namespace Controllers;

use Models\Model;
use Traits\TraitGetData;
use View\View;

class CarController
{
    use TraitGetData;

    public function newCar(string $pilot, string $make, string $model, string $color, int $year): void
    {
        ValidationController::raceInProgress($this->dataRace['Start']);
        ValidationController::pilotExists($pilot, $this->dataCars);

        $this->dataCars[] = [
            'Piloto' => $pilot,
            'Marca'  => $make,
            'Modelo' => $model,
            'Cor'    => $color,
            'Ano'    => $year
        ];

        Model::setCars($this->dataCars);
        View::successMessageNewCar();
    }

    public function deleteCar(string $pilot): void
    {
        ValidationController::raceInProgress($this->dataRace['Start']);
        ValidationController::pilotIsNull($pilot);

        foreach ($this->dataCars as $id => $dataCar) {
            if (self::existsPilot($pilot, $dataCar['Piloto'])) {
                unset($this->dataCars[$id]);

                Model::setCars($this->dataCars);
                View::successMessageDeleteCar();

                $this->ifExistsCarsThenSetPosition();

                return;
            }
        }
        View::errorMessageNotFoundCar();
    }

    public function setPosition(): void
    {
        ValidationController::carsExists($this->dataCars);

        $position = 1;

        foreach ($this->dataCars as $id => $dataCar) {
            $this->dataCars[$id]['Posicao'] = $position;
            $position++;
        }

        $carsOrdered = RaceController::orderCars($this->dataCars);
        Model::setCars($carsOrdered);

        View::successMessageSetPosition();
    }

    public function showCars(): void
    {
        ValidationController::carsExists($this->dataCars);

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
