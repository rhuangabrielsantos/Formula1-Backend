<?php

namespace Controllers;

use Helper\Validation;
use Models\Model;
use Traits\TraitGetData;
use View\View;

class RaceController
{
    use TraitGetData;

    public function startRace(): void
    {
        Validation::raceAlreadyStarted($this->dataRace['Start']);
        Validation::carsExists($this->dataCars);
        Validation::existsMoreOneCar($this->dataCars);
        Validation::positionsAreSet($this->dataCars);

        Model::startRace();

        View::successMessageStartRace();
    }

    public function finishRace(): void
    {
        Validation::raceNotStarted($this->dataRace['Start']);

        Model::finishRace();

        View::podium($this->dataCars);
    }

    public function overtake(string $winner): void
    {
        Validation::raceNotStarted($this->dataRace['Start']);
        $lost = null;

        foreach ($this->dataCars as $key => $car) {
            if ($car['Piloto'] == $winner) {
                Validation::carIsTheFirst($car);

                $carLost = $key - 1;
                $this->dataCars[$key]['Posicao'] -= 1;
                $this->dataCars[$carLost]['Posicao'] += 1;
                $lost = $this->dataCars[$carLost];
            }
        }

        $this->report[] = $winner . " ultrapassou " . $lost['Piloto'] . "!" . PHP_EOL;
        $carsOrdered = RaceController::orderCars($this->dataCars);

        Model::overtake($carsOrdered, $this->report);

        View::successMessageOvertaking($winner, $lost['Piloto']);
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
