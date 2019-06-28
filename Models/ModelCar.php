<?php

namespace Models;

class ModelCar
{
    public $dataCars;
    public $dataRace;

    public function __construct()
    {
        $this->dataCars = file_get_contents(__DIR__ . '/../filesJson/dataCars.json');
        $this->dataRace = file_get_contents(__DIR__ . '/../filesJson/dataRace.json');
    }

    public function newCar($cars)
    {
        unlink(__DIR__ . "/../filesJson/dataCars.json");
        $json = json_encode($cars, JSON_PRETTY_PRINT);
        $fp = fopen(__DIR__ . "/../filesJson/dataCars.json", "a");
        fwrite($fp, $json);
        fclose($fp);

        echo "Carro Salvo com Sucesso!" . PHP_EOL;
    }

    public function setPosition($cars)
    {
        unlink(__DIR__ . "/../filesJson/dataCars.json");
        $json = json_encode($cars, JSON_PRETTY_PRINT);
        $fp = fopen(__DIR__ . "/../filesJson/dataCars.json", "a");
        fwrite($fp, $json);
        fclose($fp);

        echo "Posicoes definidas com sucesso!" . PHP_EOL;
    }

    public function showCars()
    {
        $cars = json_decode($this->dataCars, true);

        foreach ($cars as $key => $car) {
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
