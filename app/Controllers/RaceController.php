<?php

namespace Controllers;

use Helper\Validation;
use Lib\JSON;
use Models\Race;
use Views\View;

class RaceController
{
    const PARAM_PILOT = 2;

    public $dataRace;
    public $dataCars;
    public $report;

    public function __construct()
    {
        $this->dataRace = JSON::getJson('dataRace');
        $this->dataCars = JSON::getJson('dataCars');
        $this->report = JSON::getJson('report');
    }

    public function startRace(): void
    {
        Validation::raceAlreadyStarted($this->dataRace['Start']);
        Validation::carsExists($this->dataCars);
        Validation::existsMoreOneCar($this->dataCars);
        Validation::positionsAreSet($this->dataCars);

        Race::start();

        View::successMessageStartRace();
    }

    public function finishRace(): void
    {
        Validation::raceNotStarted($this->dataRace['Start']);

        Race::finish();

        View::podium($this->dataCars);
    }

    public function overtake(array $input): void
    {
        if (!$input[self::PARAM_PILOT]) {
            View::errorMessageOvertakeNull();
        }

        Validation::raceNotStarted($this->dataRace['Start']);
        $lost = null;

        foreach ($this->dataCars as $key => $car) {
            if ($car['Piloto'] == $input[self::PARAM_PILOT]) {
                Validation::carIsTheFirst($car);

                $carLost = $key - 1;
                $this->dataCars[$key]['Posicao'] -= 1;
                $this->dataCars[$carLost]['Posicao'] += 1;
                $lost = $this->dataCars[$carLost];
            }
        }

        $this->report[] = $input[self::PARAM_PILOT] . " ultrapassou " . $lost['Piloto'] . "!" . PHP_EOL;
        $carsOrdered = RaceController::orderCars($this->dataCars);

        Race::overtake($carsOrdered, $this->report);

        View::successMessageOvertaking($input[self::PARAM_PILOT], $lost['Piloto']);
    }

    public static function orderCars(array $cars): array
    {
        sort($cars);

        $sortArray = array();
        foreach ($cars as $car) {
            foreach ($car as $key => $value) {
                if (!isset($sortArray[$key])) {
                    $sortArray[$key] = array();
                }
                $sortArray[$key][] = $value;
            }
        }

        array_multisort($sortArray['Posicao'], SORT_ASC, $cars);

        return $cars;
    }

    public function getReport()
    {
        Validation::existsReports($this->report);

        foreach ($this->report as $item) {
            View::report($item);
        }
    }
}
