<?php

namespace Controllers;

use Models\ModelCar;
use Traits\TraitGetData;
use View\View;

class ControllerCar
{
    use TraitGetData;

    public function newCar($pilot, $make, $model, $color, $year)
    {
        if ($this->dataRace['Start'] == true) {
            View::errorMessageNewCarRaceStart();
            exit;
        }

        $this->dataCars[] = [
            'Piloto' => $pilot,
            'Marca' => $make,
            'Modelo' => $model,
            'Cor' => $color,
            'Ano' => $year,
        ];

        ModelCar::setJson($this->dataCars);
        View::successMessageNewCar();
    }

    public function deleteCar($pilot)
    {
        if ($this->dataRace['Start'] == true) {
            View::errorMessageDeleteCarStartRace();
            exit;
        }

        for ($i = 0; $i <= count($this->dataCars); $i++) {
            if ($pilot == $this->dataCars[$i]['Piloto']) {
                unset($this->dataCars[$i]);
                ModelCar::setJson($this->dataCars);
                View::successMessageDeleteCar();
                exit;
            }
        }

        View::errorMessageNotFoundCar();
        exit;
    }

    public function setPosition()
    {
        if (empty($this->dataCars)) {
            View::errorMessageNeedAddCars();
            exit;
        }

        for ($i = 0; $i < count($this->dataCars); $i++) {
            $this->dataCars[$i]['Posicao'] = $i + 1;
        }

        ModelCar::setJson($this->dataCars);
        View::successMessageSetPosition();
    }

    public function showCars()
    {
        if (!empty($this->dataCars)) {
            View::logo();
            foreach ($this->dataCars as $car) {
                View::showCars($car);
            }
        } else {
            View::errorMessageNeedAddCars();
        }
    }
}
