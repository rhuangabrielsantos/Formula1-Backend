<?php

namespace Controllers;

use Models\Model;
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

        if (!empty($cars)) {
            foreach ($cars as $car) {
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
            'Ano' => $year,
        ];

        Model::setJson($this->dataCars);

        if ($this->godMode['Status'] == false) {
            View::successMessageNewCar();
        }
    }

    public function deleteCar($pilot)
    {
        if ($this->dataRace['Start'] == true) {
            View::errorMessageDeleteCarStartRace();
            exit;
        }

        if(empty($pilot)) {
            View::errorMessageDeleteCar();
            exit;
        }

        for ($i = 0; $i <= count($this->dataCars); $i++) {
            if ($pilot == $this->dataCars[$i]['Piloto']) {
                unset($this->dataCars[$i]);
                Model::setJson($this->dataCars);
                if ($this->godMode['Status'] == false) {
                    View::successMessageDeleteCar();
                }
            } else {
                View::errorMessageNotFoundCar();
                exit;
            }
        }
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

        Model::setJson($this->dataCars);
        if ($this->godMode['Status'] == false) {
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
            View::errorMessageNeedAddCars();
        }
    }
}
