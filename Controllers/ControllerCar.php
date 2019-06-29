<?php

namespace Controllers;

use Lib\JSON;
use Models\ModelCar;
use View\View;

class ControllerCar
{
    public $dataCars;
    public $dataRace;

    public function __construct()
    {
        $this->dataRace = JSON::getDataRace();
        $this->dataCars = JSON::getDataCars();
    }

    public function newCar($pilot, $make, $model, $color, $year)
    {
        if ($this->dataRace['Start'] == true) {
            View::errorMessageNewCar();
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
            foreach ($this->dataCars as $car) {
                View::showCars($car);
            }
        } else {
            View::errorMessageNeedAddCars();
        }
    }
}
