<?php

namespace Controllers;

use Models\Model;
use Traits\TraitGetData;
use View\View;

class RaceController
{
    use TraitGetData;

    public function startRace(): void
    {
        ValidationController::raceAlreadyStarted($this->dataRace['Start']);
        ValidationController::existsMoreOneCar($this->dataCars);
        ValidationController::positionsAreSet($this->dataCars);

        Model::startRace();

        View::successMessageStartRace();
    }

    public function finishRace(): void
    {
        ValidationController::raceNotStarted($this->dataRace['Start']);

        Model::finishRace();

        View::podium($this->dataCars);
    }

    public function overtake(string $winner): void
    {
        ValidationController::raceNotStarted($this->dataRace['Start']);
        $lost = null;

        foreach ($this->dataCars as $key => $car) {
            if ($car['Piloto'] == $winner) {
                ValidationController::carIsTheFirst($car);

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
        ValidationController::existsReports($this->report);

        foreach ($this->report as $item) {
            View::report($item);
        }
    }
}
