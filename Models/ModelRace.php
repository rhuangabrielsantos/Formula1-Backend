<?php

namespace Models;

class ModelRace
{
    public $start;
    public $report;
    public $dataCars;
    public $dataRace;

    public function __construct()
    {
        $this->start = false;
        $this->dataCars = file_get_contents(__DIR__ . '/../filesJson/dataCars.json');
        $this->dataRace = file_get_contents(__DIR__ . '/../filesJson/dataRace.json');
        $this->report = file_get_contents(__DIR__ . '/../filesJson/report.json');
    }

    public function startRace()
    {
        $cars = json_decode($this->dataCars, true);

        if (empty($cars)) {
            echo "Adicione carros para iniciar a corrida" . PHP_EOL;
            exit;
        }

        if (count($cars) == 1) {
            echo "Impossivel comecar corrida com apenas um carro" . PHP_EOL;
            exit;
        }

        foreach ($cars as $car) {
            if (empty($car['Posicao'])) {
                echo "Voce precisa definir as posicoes" . PHP_EOL;
                exit;
            }
        }

        $race = json_decode($this->dataRace, true);

        if ($race['Start'] == true) {
            echo "Voce já iniciou a corrida!" . PHP_EOL;
            exit;
        }

        unlink(__DIR__ . "/../filesJson/report.json");
        $fp = fopen(__DIR__ . "/../filesJson/report.json", "a");
        fclose($fp);

        echo "Corrida Iniciada!" . PHP_EOL;

        $start = [
            "Start" => true
        ];

        unlink(__DIR__ . "/../filesJson/dataRace.json");
        $json = json_encode($start, JSON_PRETTY_PRINT);
        $fp = fopen(__DIR__ . "/../filesJson/dataRace.json", "a");
        fwrite($fp, $json);
        fclose($fp);
    }

    public function overtake($win)
    {
        $cars = json_decode($this->dataCars, true);
        $race = json_decode($this->dataRace, true);
        $report = json_decode($this->report, true);

        if ($race['Start'] == true) {
            foreach ($cars as $key => $car) {
                if ($car['Piloto'] == $win) {
                    if ($car['Posicao'] == 1) {
                        echo $car['Piloto'] . " esta em primeiro lugar" . PHP_EOL;
                        exit;
                    }
                    $anterior = $key - 1;
                    $cars[$key]['Posicao'] -= 1;
                    $cars[$anterior]['Posicao'] += 1;
                    $lost = $cars[$anterior];
                } else {
                    echo "Piloto nao encontrado" . PHP_EOL;
                    exit;
                }
            }

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


            unlink(__DIR__ . "/../filesJson/dataCars.json");
            $json = json_encode($cars, JSON_PRETTY_PRINT);
            $fp = fopen(__DIR__ . "/../filesJson/dataCars.json", "a");
            fwrite($fp, $json);
            fclose($fp);

            echo $win . " ultrapassou " . $lost['Piloto'] . "!!" . PHP_EOL;

            $report[] = $win . " ultrapassou " . $lost['Piloto'] . "!!" . PHP_EOL;

            unlink(__DIR__ . "/../filesJson/report.json");
            $json = json_encode($report, JSON_PRETTY_PRINT);
            $fp = fopen(__DIR__ . "/../filesJson/report.json", "a");
            fwrite($fp, $json);
            fclose($fp);

        } else {
            echo "Voce precisa iniciar a corrida" . PHP_EOL;
            exit;
        }
    }

    public function finishRace()
    {
        $cars = json_decode($this->dataCars, true);
        $race = json_decode($this->dataRace, true);

        if ($race['Start'] == true) {
            $p = 1;

            echo "Corrida Finalizada!" . PHP_EOL . PHP_EOL;
            echo "Ganhadores:" . PHP_EOL;
            for ($i = 0; $i < 3; $i++) {
                echo $p . "- " . $cars[$i]['Piloto'] . PHP_EOL;
                $p++;
            }

            $start = [
                "Start" => false
            ];

            unlink(__DIR__ . "/../filesJson/dataRace.json");
            $json = json_encode($start, JSON_PRETTY_PRINT);
            $fp = fopen(__DIR__ . "/../filesJson/dataRace.json", "a");
            fwrite($fp, $json);
            fclose($fp);

        } else {
            echo "Voce precisa iniciar a corrida!" . PHP_EOL;
        }
    }

    public function report()
    {
        $report = json_decode($this->report, true);

        foreach ($report as $item) {
            echo $item;
        }
    }
}
