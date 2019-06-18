<?php

namespace Controllers;

class Car
{
    private $cars;
    private $size;
    private $start;
    private $report;

    public function __construct()
    {
        $this->start = false;
        $this->report = "Relatorio de Ultrapassagens:" . PHP_EOL;
    }

    public function newCar($pilot, $make, $model, $color, $year)
    {
        $array = [
            'Piloto' => $pilot,
            'Marca' => $make,
            'Modelo' => $model,
            'Cor' => $color,
            'Ano' => $year,
        ];

        $this->cars[] = $array;

        $this->size++;
    }

    public function setPosition()
    {
        if (empty($this->cars)) {
            echo "Voce precisa adicionar carros" . PHP_EOL;
            exit;
        } else {
            for ($i = 0; $i < $this->size; $i++) {
                $this->cars[$i]['Posicao'] = $i + 1;
            }
        }
    }

    public function showCars()
    {
        $sortArray = array();

        foreach ($this->cars as $car) {
            foreach ($car as $key => $value) {
                if (!isset($sortArray[$key])) {
                    $sortArray[$key] = array();
                }
                $sortArray[$key][] = $value;
            }
        }

        $orderby = "Posicao";

        array_multisort($sortArray[$orderby], SORT_ASC, $this->cars);

        print_r($this->cars);
    }

    public function startRace()
    {
        if (empty($this->cars['0']['Posicao'])) {
            echo "Voce precisa definir as posicoes" . PHP_EOL;
            exit;
        } else {
            echo "Corrida Iniciada!" . PHP_EOL;
            $this->start = true;
        }
    }

    public function overtake($win, $lost)
    {
        if ($this->start == true) {
            for ($i = 0; $i < $this->size; $i++) {
                switch ($win) {
                    case $this->cars[$i]['Piloto']:
                        if ($this->cars[$i]['Posicao'] == 1) {
                            echo "Ultrapassagem Impossivel" . PHP_EOL;
                            exit;
                        } else {
                            $win = $this->cars[$i];
                            $this->cars[$i]['Posicao'] -= 1;
                            break;
                        }

                }

                switch ($lost) {
                    case $this->cars[$i]['Piloto']:
                        $lost = $this->cars[$i];
                        $this->cars[$i]['Posicao'] += 1;
                        break;
                }
            }

            foreach ($this->cars as $car) {
                foreach ($this->cars as $test) {
                    if ($car['Piloto'] != $test['Piloto'] && $car['Posicao'] == $test['Posicao']) {
                        echo "Ultrapassagem Impossivel" . PHP_EOL;
                        exit;
                    }
                }
            }

            $this->report .= " - " . $win['Piloto'] . " Ultrapassou " . $lost['Piloto'] . PHP_EOL;

        } else {
            echo "Voce precisa iniciar a corrida" . PHP_EOL;
            exit;
        }
    }

    public function finishRace()
    {
        if ($this->start == true) {
            $sortArray = array();

            foreach ($this->cars as $car) {
                foreach ($car as $key => $value) {
                    if (!isset($sortArray[$key])) {
                        $sortArray[$key] = array();
                    }
                    $sortArray[$key][] = $value;
                }
            }

            $orderby = "Posicao";

            array_multisort($sortArray[$orderby], SORT_ASC, $this->cars);

            echo "Corrida Finalizada!" . PHP_EOL . PHP_EOL;
            echo "Ganhadores:" . PHP_EOL;
            echo "1 - " . $this->cars[0]['Piloto']. PHP_EOL;
            echo "2 - " . $this->cars[1]['Piloto']. PHP_EOL;
            echo "3 - " . $this->cars[2]['Piloto']. PHP_EOL . PHP_EOL;


        }
    }

    public function report()
    {
        echo $this->report;
    }
}
