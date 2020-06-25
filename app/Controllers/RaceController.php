<?php

namespace Controllers;

use Helper\Validation;
use Views\View;

class RaceController
{
    private $validation;

    public function __construct()
    {
        $this->validation = new Validation();
    }

    public function startRace(): array
    {
        return ['Start' => 'on'];
    }

    public function finishRace(): array
    {
        return ['Start' => 'off'];
    }

    public function overtake(string $pilotName, array $dataCars, array $reports): array
    {
        $lost = null;

        foreach ($dataCars as $key => $car) {
            if ($car['Piloto'] == $pilotName) {
                $this->validation->carIsTheFirst($car);

                $carLost = $key - 1;
                $dataCars[$key]['Posicao'] -= 1;
                $dataCars[$carLost]['Posicao'] += 1;
                $lost = $dataCars[$carLost];
            }
        }

        $reports[] = $pilotName . " ultrapassou " . $lost['Piloto'] . "!" . PHP_EOL;
        $carsOrdered = RaceController::orderCars($dataCars);

        View::successMessageOvertaking($pilotName, $lost['Piloto']);

        return [$carsOrdered, $reports];
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

    public function showReports(array $reports): void
    {
        foreach ($reports as $report) {
            View::report($report);
        }
    }
}
