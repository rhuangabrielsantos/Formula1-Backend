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

        if (empty($pilot)) {
            View::errorMessageDeleteCar();
            exit;
        }

        foreach ($this->dataCars as $id => $dataCar) {
            if ($pilot == $dataCar['Piloto']) {
                unset($this->dataCars[$id]);
                $this->setPosition(false);
                Model::setJson($this->dataCars);
                if ($this->godMode['Status'] == false) {
                    View::successMessageDeleteCar();
                    exit;
                }
            }
        }
        View::errorMessageNotFoundCar();
    }

    public function setPosition($msg = true)
    {
        if (empty($this->dataCars)) {
            View::errorMessageNeedAddCars();
            exit;
        }

        $position = 1;

        foreach ($this->dataCars as $id => $dataCar) {
            $this->dataCars[$id]['Posicao'] = $position;
            $position++;
        }

        Model::setJson($this->dataCars);
        if ($this->godMode['Status'] == false && $msg == true) {
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
