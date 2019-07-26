<?php

namespace Controllers;

use Models\Model;
use Traits\TraitGetData;
use View\View;

class CarController
{
    use TraitGetData;

    public function newCar($pilot, $make, $model, $color, $year)
    {
        if ($this->dataRace['Start'] == true) {
            View::errorMessageNewCarRaceStart();
            exit;
        }

        if (!empty($this->dataCars)) {
            foreach ($this->dataCars as $car) {
                if ($pilot == $car['Piloto']) {
                    View::errorMessageNewCarExistPilot();
                    exit;
                }
            }
        }

        $this->dataCars[] = [
            'Piloto' => $pilot,
            'Marca' => $make,
            'Modelo' => $model,
            'Cor' => $color,
            'Ano' => $year
        ];

        Model::setJson($this->dataCars);
        View::successMessageNewCar();
    }

    public function deleteCar($pilot)
    {
        if ($this->dataRace['Start'] == true) {
            View::errorMessageDeleteCarStartRace();
            exit;
        }

        if (empty($pilot)) {
            View::errorMessageDeleteCar();
            exit;
        }

        foreach ($this->dataCars as $id => $dataCar) {
            if ($pilot == $dataCar['Piloto']) {
                unset($this->dataCars[$id]);
                if (count($this->dataCars) > 0) {
                    $this->setPosition(false);
                }
                Model::setJson($this->dataCars);
                View::successMessageDeleteCar();
                return;
            }
        }
        View::errorMessageNotFoundCar();
    }

    public function setPosition($msg = true)
    {
        if (empty($this->dataCars)) {
            View::errorMessageEmpty();
            exit;
        }

        $position = 1;

        foreach ($this->dataCars as $id => $dataCar) {
            $this->dataCars[$id]['Posicao'] = $position;
            $position++;
        }

        $carsOrdered = RaceController::orderCars($this->dataCars);
        Model::setJson($carsOrdered);
        if ($msg == true) {
            View::successMessageSetPosition();
        }
    }

    public function showCars()
    {
        if (!empty($this->dataCars)) {
            View::logo();
            foreach ($this->dataCars as $car) {
                View::showCars($car);
            }
        } else {
            View::errorMessageEmpty();
        }
    }
}
