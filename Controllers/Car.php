<?php

namespace Controllers;

class Car
{
    public $cars;
    public $size;

    public function newCar($pilot, $make, $model, $color, $year)
    {
        $file = file_get_contents('/../carros.json');

        $array = json_decode($file);
        unlink("/../carros.json");

        $array[] = [
            'Piloto' => $pilot,
            'Marca' => $make,
            'Modelo' => $model,
            'Cor' => $color,
            'Ano' => $year,
        ];

        $json = json_encode($array);

        $fp = fopen("carros.json", "a");

        fwrite($fp, $json);
        fclose($fp);


        $this->cars[] = $array;

        $this->size++;

        return $array;
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
            exit;

        }

    }
}
