<?php

namespace Models;

class Race
{
    public $start;
    public $report;
    public $dataCars;
    public $dataRace;

    public function __construct()
    {
        $this->start = false;
        $this->report = "Relatorio de Ultrapassagens:";
        $this->dataCars = file_get_contents(__DIR__ . '/../filesJson/dataCars.json');
        $this->dataRace = file_get_contents(__DIR__ . '/../filesJson/dataRace.json');
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
            echo "Voce já iniciou a corrida!";
        }

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

    public function overtake($win, $lost)
    {
        $cars = json_decode($this->dataCars, true);
        $race = json_decode($this->dataRace, true);

        if ($win === $lost) {
            echo "Impossivel ultrapassar ele mesmo!" . PHP_EOL;
            exit;
        }
        if ($race['Start'] == true) {
            for ($i = 0; $i < count($cars); $i++) {
                switch ($win) {
                    case $cars[$i]['Piloto']:
                        $win = $cars[$i];
                        $cars[$i]['Posicao'] -= 1;
                        break;
                }

                switch ($lost) {
                    case $cars[$i]['Piloto']:
                        $lost = $cars[$i];
                        $cars[$i]['Posicao'] += 1;
                        break;
                }
            }

            foreach ($cars as $car) {
                foreach ($cars as $test) {
                    if ($car['Piloto'] != $test['Piloto'] && $car['Posicao'] == $test['Posicao']) {
                        echo "Ultrapassagem Impossivel de " . $win['Piloto'] . " para " . $lost['Piloto'] . PHP_EOL;
                        exit;
                    }
                }
            }

            $this->report .= PHP_EOL . " - " . $win['Piloto'] . " Ultrapassou " . $lost['Piloto'];

            return true;

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
            $p = 1;

            array_multisort($sortArray[$orderby], SORT_ASC, $cars);

            echo "Corrida Finalizada!" . PHP_EOL . PHP_EOL;
            echo "Ganhadores:" . PHP_EOL;
            for ($i = 0; $i < count($cars); $i++) {
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
        if ($this->report == 'Relatorio de Ultrapassagens:') {
            echo "N�o houve ultrapassagens" . PHP_EOL;
            exit;
        } else {
            echo PHP_EOL . $this->report . PHP_EOL . PHP_EOL;
            return true;
        }
    }
}
