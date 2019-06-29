<?php

namespace Controllers;

use Lib\JSON;
use Models\ModelRace;
use View\View;

class ControllerRace
{
    public $dataCars;
    public $dataRace;
    public $report;

    public function __construct()
    {
        $this->dataRace = JSON::getDataRace();
        $this->dataCars = JSON::getDataCars();
        $this->report = JSON::getReport();
    }

    public function startRace()
    {
        if (empty($this->dataCars)) {
            View::errorMessageNeedAddCars();
            exit;
        }

        if (count($this->dataCars) == 1) {
            View::errorMessageOneCar();
            exit;
        }

        foreach ($this->dataCars as $car) {
            if (empty($car['Posicao'])) {
                View::errorMessageNeedDefinePosition();
                exit;
            }
        }

        if ($this->dataRace['Start'] == true) {
            View::errorMessageStartAgain();
            exit;
        }

        $start = [
            "Start" => true
        ];

        ModelRace::startRace($start);
        View::successMessageStartRace();
    }

    public function finishRace()
    {
        if ($this->dataRace['Start'] == true) {

            View::podium($this->dataCars);

            $start = [
                "Start" => false
            ];

            ModelRace::setRace($start);

        } else {
            View::errorMessageNeedStart();
        }
    }

    public function overtake($win)
    {
        if ($this->dataRace['Start'] == true) {
            foreach ($this->dataCars as $key => $car) {
                if ($car['Piloto'] == $win) {
                    if ($car['Posicao'] == 1) {
                        View::errorMessageOvertakingFirsPlace($car);
                        exit;
                    }
                    $anterior = $key - 1;
                    $this->dataCars[$key]['Posicao'] -= 1;
                    $this->dataCars[$anterior]['Posicao'] += 1;
                    $lost = $this->dataCars[$anterior];
                }
            }

            if (!isset($anterior)) {
                View::errorMessageNotFoundPilot();
                exit;
            }

            $this->report[] = $win . " ultrapassou " . $lost['Piloto'] . "!" . PHP_EOL;

            $carsOrdered = ControllerRace::orderCars($this->dataCars);
            ModelRace::overtake($carsOrdered, $this->report);

            View::successMessageOvertaking($win, $lost);

        } else {
            View::errorMessageNeedStart();
            exit;
        }
    }

    public static function orderCars($cars)
    {
        $sortArray = array();
        foreach ($cars as $car) {
            foreach ($car as $key => $value) {
                if (!isset($sortArray[$key])) {
                    $sortArray[$key] = array();
                }
                $sortArray[$key][] = $value;
            }
        }
        $orderby = "Posicao";
        array_multisort($sortArray[$orderby], SORT_ASC, $cars);

        return $cars;
    }

    public function getReport()
    {
        foreach ($this->report as $item) {
            View::report($item);
        }
    }
}
