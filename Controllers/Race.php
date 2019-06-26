<?php

namespace Controllers;

class Race extends Car
{
    private $start;
    private $report;

    public function __construct()
    {
        $this->start = false;
        $this->report = "Relatorio de Ultrapassagens:";
    }

    public function startRace()
    {
        if (empty($this->cars)) {
            echo "Voce precisa adicionar carros" . PHP_EOL;
            exit;
        }
        if (empty($this->cars['0']['Posicao'])) {
            echo "Voce precisa definir as posicoes" . PHP_EOL;
            exit;
        } else {
            echo "Corrida Iniciada!" . PHP_EOL;
            $this->start = true;
        }

        return $this->start;
    }

    public function overtake($win, $lost)
    {
        if ($win === $lost) {
            echo "Impossivel ultrapassar ele mesmo!" . PHP_EOL;
            exit;
        }
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
            return true;
        }
        return false;
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
