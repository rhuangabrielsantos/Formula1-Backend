<?php

namespace Controllers;

use Lib\JSON;
use Models\Model;
use Traits\TraitGetData;
use View\View;

class RaceController
{
    use TraitGetData;

    public function startRace()
    {
        if (empty($this->dataCars)) {
            View::errorMessageEmpty();
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

        sort($this->dataCars);

        $carsOrdered = RaceController::orderCars($this->dataCars);
        Model::setJson($carsOrdered);
        Model::startRace($start);
        View::successMessageStartRace();

    }

    public function finishRace()
    {
        if ($this->dataRace['Start'] == true) {
            View::podium($this->dataCars);

            $start = [
                "Start" => false
            ];

            JSON::setJson('dataRace', $start);

        } else {
            View::errorMessageNeedStart();
        }
    }

    public function overtake($win)
    {
        $lost = null;

        if ($this->dataRace['Start'] == true) {
            foreach ($this->dataCars as $key => $car) {
                if ($car['Piloto'] == $win) {
                    if ($car['Posicao'] == 1) {
                        View::errorMessageOvertakingFirsPlace($car);
                        exit;
                    }
                    $carLost = $key - 1;
                    $this->dataCars[$key]['Posicao'] -= 1;
                    $this->dataCars[$carLost]['Posicao'] += 1;
                    $lost = $this->dataCars[$carLost];
                }
            }

            if (!isset($carLost)) {
                View::errorMessageNotFoundPilot();
                exit;
            }

            $this->report[] = $win . " ultrapassou " . $lost['Piloto'] . "!" . PHP_EOL;

            $carsOrdered = RaceController::orderCars($this->dataCars);
            Model::overtake($carsOrdered, $this->report);
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
        $orderBy = "Posicao";
        array_multisort($sortArray[$orderBy], SORT_ASC, $cars);

        return $cars;
    }

    public function getReport()
    {
        View::logo();

        if (!empty($this->report)) {
            foreach ($this->report as $item) {
                View::report($item);
            }
        } else {
            View::errorMessageEmptyReport();
        }
    }
}
