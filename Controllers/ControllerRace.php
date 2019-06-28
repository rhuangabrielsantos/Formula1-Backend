<?php

namespace Controllers;

use Lib\JSON;
use Models\ModelRace;

class ControllerRace
{
    public $dataCars;
    public $dataRace;

    public function __construct()
    {
        $this->dataRace = JSON::getDataRace();
        $this->dataCars = JSON::getDataCars();
    }

    public function startRace()
    {
        if (empty($this->dataCars)) {
            echo "Adicione carros para iniciar a corrida" . PHP_EOL;
            exit;
        }

        if (count($this->dataCars) == 1) {
            echo "Impossivel comecar corrida com apenas um carro" . PHP_EOL;
            exit;
        }

        foreach ($this->dataCars as $car) {
            if (empty($car['Posicao'])) {
                echo "Voce precisa definir as posicoes" . PHP_EOL;
                exit;
            }
        }

        if ($this->dataRace['Start'] == true) {
            echo "Voce ja iniciou a corrida!" . PHP_EOL;
            exit;
        }

        $start = [
            "Start" => true
        ];

        ModelRace::startRace($start);

        echo "Corrida Iniciada!" . PHP_EOL;
    }

    public function finishRace()
    {
        if ($this->dataRace['Start'] == true) {
            $p = 1;

            echo "Corrida Finalizada!" . PHP_EOL . PHP_EOL;
            echo "Ganhadores:" . PHP_EOL;
            for ($i = 0; $i < 3; $i++) {
                echo $p . "- " . $this->dataCars[$i]['Piloto'] . PHP_EOL;
                $p++;
            }

            $start = [
                "Start" => false
            ];

            ModelRace::setRace($start);

        } else {
            echo "Voce precisa iniciar a corrida!" . PHP_EOL;
        }
    }

    public function overtake($win)
    {
        if ($this->dataRace['Start'] == true) {
            foreach ($this->dataCars as $key => $car) {
                if ($car['Piloto'] == $win) {
                    if ($car['Posicao'] == 1) {
                        echo $car['Piloto'] . " esta em primeiro lugar" . PHP_EOL;
                        exit;
                    }
                    $anterior = $key - 1;
                    $this->dataCars[$key]['Posicao'] -= 1;
                    $this->dataCars[$anterior]['Posicao'] += 1;
                    $lost = $this->dataCars[$anterior];
                }
            }

            $report[] = $win . " ultrapassou " . $lost['Piloto'] . "!!" . PHP_EOL;

            $carsOrdered = ControllerRace::orderCars($this->dataCars);
            ModelRace::overtake($carsOrdered, $report);

            echo $win . " ultrapassou " . $lost['Piloto'] . "!!" . PHP_EOL;

        } else {
            echo "Voce precisa iniciar a corrida" . PHP_EOL;
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
}
