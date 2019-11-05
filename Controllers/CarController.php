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
        $this->validationRaceInProgress();
        $this->validationPilotExists($pilot);

        $this->dataCars[] = [
            'Piloto' => $pilot,
            'Marca' => $make,
            'Modelo' => $model,
            'Cor' => $color,
            'Ano' => $year
        ];

        Model::setCars($this->dataCars);
        View::successMessageNewCar();
    }

    public function deleteCar(string $pilot): void
    {
        $this->validationRaceInProgress();
        $this->validationPilotIsNull($pilot);

        foreach ($this->dataCars as $id => $dataCar) {
            if (self::existsPilot($pilot, $dataCar['Piloto'])) {
                unset($this->dataCars[$id]);

                $this->ifExistsCarsThenSetPosition();

                Model::setCars($this->dataCars);
                View::successMessageDeleteCar();
                return;
            }
        }
        View::errorMessageNotFoundCar();
    }

    public function setPosition($msg = true): void
    {
        $this->validationCarsExists();

        $position = 1;

        foreach ($this->dataCars as $id => $dataCar) {
            $this->dataCars[$id]['Posicao'] = $position;
            $position++;
        }

        $carsOrdered = RaceController::orderCars($this->dataCars);
        Model::setCars($carsOrdered);

        if ($msg == true) {
            View::successMessageSetPosition();
        }
    }

    public function showCars(): void
    {
        $this->validationCarsExists();

        foreach ($this->dataCars as $car) {
            View::showCar($car);
        }
    }

    private function validationRaceInProgress(): void
    {
        if ($this->dataRace['Start'] == 'on') {
            View::errorMessageNewCarRaceStart();
            exit;
        }
    }

    public function validationPilotExists(string $pilot): void
    {
        if (empty($this->dataCars)) {
            return;
        }

        foreach ($this->dataCars as $car) {
            if ($pilot == $car['Piloto']) {
                View::errorMessageNewCarExistPilot();
                exit;
            }
        }
    }

    private function validationPilotIsNull(string $pilot): void
    {
        if (empty($pilot)) {
            View::errorMessageDeleteCar();
            exit;
        }
    }

    private static function existsPilot(string $pilot, string $data): bool
    {
        return $pilot == $data;
    }

    private function ifExistsCarsThenSetPosition(): void
    {
        if (count($this->dataCars) > 0) {
            $this->setPosition(false);
        }
    }

    private function validationCarsExists(): void
    {
        if (empty($this->dataCars)) {
            View::errorMessageEmpty();
            exit;
        }
    }
}
