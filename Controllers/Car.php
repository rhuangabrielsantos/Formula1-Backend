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
        $this->report = "Relatorio de Ultrapassagens:";
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

        return $array;
    }

    public function setPosition()
    {
        if (empty($this->cars)) {
            echo "Voce precisa adicionar carros" . PHP_EOL;
            return false;
        } else {
            for ($i = 0; $i < $this->size; $i++) {
                $this->cars[$i]['Posicao'] = $i + 1;
            }
        }
    }

    public function showCars()
    {
        if (isset($this->cars)) {
            $sortArray = array();

            foreach ($this->cars as $car) {
                foreach ($car as $key => $value) {
                    if (!isset($sortArray[$key])) {
                        $sortArray[$key] = array();
                    }
                    $sortArray[$key][] = $value;
                }
            }

            if (isset($this->cars[0]['Posicao'])) {
                $orderby = "Posicao";
            } else {
                $orderby = "Piloto";
            }

            array_multisort($sortArray[$orderby], SORT_ASC, $this->cars);
            print_r($this->cars);
            return true;

        } else {
            echo "Adicione carros!" . PHP_EOL;
            return false;

        }

    }

    public function startRace()
    {
        if (empty($this->cars)) {
            echo "Voce precisa adicionar carros";
            return false;
        }
        if (empty($this->cars['0']['Posicao'])) {
            echo "Voce precisa definir as posicoes" . PHP_EOL;
            return false;
        } else {
            echo "Corrida Iniciada!" . PHP_EOL;
            $this->start = true;
        }

        return $this->start;
    }

    public function overtake($win, $lost)
    {
        if ($this->start == true) {
            for ($i = 0; $i < $this->size; $i++) {
                switch ($win) {
                    case $this->cars[$i]['Piloto']:
                        $win = $this->cars[$i];
                        $this->cars[$i]['Posicao'] -= 1;
                        break;
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
                        return false;
                    }
                }
            }

            $this->report .= PHP_EOL . " - " . $win['Piloto'] . " Ultrapassou " . $lost['Piloto'] . PHP_EOL;

            return true;

        } else {
            echo "Voce precisa iniciar a corrida" . PHP_EOL;
            return false;
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
            $p = 1;

            array_multisort($sortArray[$orderby], SORT_ASC, $this->cars);

            echo "Corrida Finalizada!" . PHP_EOL . PHP_EOL;
            echo "Ganhadores:" . PHP_EOL;
            for ($i = 0; $i < 3; $i++) {
                if (isset($this->cars[$i])) {
                    echo $p . "- " . $this->cars[$i]['Piloto'] . PHP_EOL;
                    $p++;
                }
            }

            echo PHP_EOL;

            return true;
        }

        return false;
    }

    public function report()
    {
        if ($this->report == 'Relatorio de Ultrapassagens:') {
            echo "Não houve ultrapassagens" . PHP_EOL;
            return false;
        } else {
            echo $this->report;
            return true;
        }
    }
}
