<?php

namespace Controllers;

use Lib\JSON;
use Models\ModelCar;

class ControllerCar
{
    public $dataCars;
    public $dataRace;

    public function __construct()
    {
        $this->dataRace = JSON::getDataRace();
        $this->dataCars = JSON::getDataCars();
    }

    public function newCar($pilot, $make, $model, $color, $year)
    {
        if ($this->dataRace['Start'] == true) {
            echo "A corrida foi Iniciada, voce nao pode adicionar carros" . PHP_EOL;
            exit;
        }

        $this->dataCars[] = [
            'Piloto' => $pilot,
            'Marca' => $make,
            'Modelo' => $model,
            'Cor' => $color,
            'Ano' => $year,
        ];

        ModelCar::setJson('dataCars', $this->dataCars);

        echo "Carro Salvo com Sucesso!" . PHP_EOL;
    }

    public function setPosition()
    {
        if (empty($this->dataCars)) {
            echo "Voce precisa adicionar carros" . PHP_EOL;
            exit;
        }

        for ($i = 0; $i < count($this->dataCars); $i++) {
            $this->dataCars[$i]['Posicao'] = $i + 1;
        }

        ModelCar::setJson('dataCars', $this->dataCars);

        echo "Posicoes Definidas com Sucesso!" . PHP_EOL;
    }

    public function showCars()
    {
        foreach ($this->dataCars as $key => $car) {
            $key = $key + 1;
            echo "-----------------------------" . PHP_EOL
                . "Carro n " . $key . PHP_EOL
                . "Piloto - " . $car['Piloto'] . PHP_EOL
                . "Marca - " . $car['Marca'] . PHP_EOL
                . "Modelo - " . $car['Modelo'] . PHP_EOL
                . "Cor - " . $car['Cor'] . PHP_EOL
                . "Ano - " . $car['Ano'] . PHP_EOL;

            if (!empty($car['Posicao'])) {
                echo "Posicao - " . $car['Posicao'] . PHP_EOL . PHP_EOL;
            } else {
                echo PHP_EOL;
            }
        }
    }
}
