<?php

namespace Controllers;

use Models\ModelCar;

class ControllerCar
{
    public $dataCars;
    public $dataRace;

    public function __construct()
    {
        $this->dataCars = json_decode(file_get_contents(__DIR__ . '/../filesJson/dataCars.json'), true);
        $this->dataRace = json_decode(file_get_contents(__DIR__ . '/../filesJson/dataRace.json'), true);
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

        $car = new ModelCar();
        $car->newCar($this->dataCars);
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

        $car = new ModelCar();
        $car->setPosition($this->dataCars);
    }
}
