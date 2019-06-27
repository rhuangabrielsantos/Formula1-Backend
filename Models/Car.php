<?php

namespace Models;

class Car
{
    public $dataCars;

    public function __construct()
    {
        $this->dataCars = file_get_contents(__DIR__ . '/../filesJson/dataCars.json');
    }

    public function newCar($pilot, $make, $model, $color, $year)
    {
        $cars = json_decode($this->dataCars);
        unlink(__DIR__ . "/../filesJson/dataCars.json");

        $cars[] = [
            'Piloto' => $pilot,
            'Marca' => $make,
            'Modelo' => $model,
            'Cor' => $color,
            'Ano' => $year,
        ];

        $json = json_encode($cars, JSON_PRETTY_PRINT);
        $fp = fopen(__DIR__ . "/../filesJson/dataCars.json", "a");
        fwrite($fp, $json);
        fclose($fp);

        echo "Carro Salvo com Sucesso!" . PHP_EOL;
    }

    public function setPosition()
    {
        $cars = json_decode($this->dataCars, true);
        unlink(__DIR__ . "/../filesJson/dataCars.json");

        if (empty($cars)) {
            echo "Voce precisa adicionar carros" . PHP_EOL;
            exit;
        }

        for ($i = 0; $i < count($cars); $i++) {
            $cars[$i]['Posicao'] = $i + 1;
        }

        $json = json_encode($cars, JSON_PRETTY_PRINT);
        $fp = fopen(__DIR__ . "/../filesJson/dataCars.json", "a");
        fwrite($fp, $json);
        fclose($fp);

        echo "Posicoes definidas com sucesso!" . PHP_EOL;
    }

    public function showCars()
    {
        $cars = json_decode($this->dataCars, true);

        foreach ($cars as $key=>$car) {
            $key = $key + 1;
            echo "-----------------------------" . PHP_EOL
                . "Carro n ". $key . PHP_EOL
                . "Piloto - " . $car['Piloto'] . PHP_EOL
                . "Marca - " . $car['Marca'] . PHP_EOL
                . "Modelo - " . $car['Modelo'] . PHP_EOL
                . "Cor - " . $car['Cor'] . PHP_EOL
                . "Ano - " . $car['Ano'] . PHP_EOL
                . "Posicao - " . $car['Posicao'] . PHP_EOL . PHP_EOL;
        }
    }
}
