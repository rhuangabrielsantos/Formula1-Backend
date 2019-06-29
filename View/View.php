<?php

namespace View;

class View
{
    public static function errorMessageNewCar()
    {
        echo "\e[00;31mA corrida foi Iniciada, para adicionar novos carros a corrida precisa ser encerrada" . PHP_EOL
            . "\e[00;33mPara encerrar uma corrida digite o comando ./finalizarCorrida\e[00;37m" . PHP_EOL;
    }

    public static function errorMessageNeedAddCars()
    {
        echo "\e[00;31mVoce precisa adicionar carros" . PHP_EOL
            . "\e[00;33mPara adicionar carros use o comando ./adicionarCarros\e[00;37m" . PHP_EOL;
    }

    public static function errorMessageOneCar()
    {
        echo "\e[00;31mImpossivel comecar corrida com apenas um carro" . PHP_EOL
            . "\e[00;33mAdicione novos carros com o comando ./adicionarCarros\e[00;37m" . PHP_EOL;
    }

    public static function errorMessageNeedDefinePosition()
    {
        echo "\e[00;31mPara iniciar a corrida, os carros precisam de posicoes definidas" . PHP_EOL
            . "\e[00;33mDefina as posicoes com o comando ./definirPosicoes \e[00;37m" . PHP_EOL;
    }

    public static function errorMessageStartAgain()
    {
        echo "\e[00;31mVoce ja iniciou a corrida!\e[00;37m" . PHP_EOL;
    }

    public static function errorMessageNeedStart()
    {
        echo "\e[00;31mVoce precisa iniciar a corrida!" . PHP_EOL
            . "\e[00;33mPara iniciar uma corrida use o comando ./iniciarCorrida\e[00;37m" . PHP_EOL;
    }

    public static function errorMessageOvertakingFirsPlace($car)
    {
        echo "\e[00;31m" . $car['Piloto'] . " esta em primeiro lugar\e[00;37m" . PHP_EOL;
    }

    public static function errorMessageNotFoundPilot()
    {
        echo "\e[00;31mPiloto nao encontrado!". PHP_EOL
            ."\e[00;33mVerifique o nome do piloto e escreva novamente\e[00;37m" . PHP_EOL;
    }

    public static function successMessageNewCar()
    {
        echo "\e[00;32mCarro Salvo com Sucesso!" . PHP_EOL
            . "\e[00;33mLembre-se de definir a posicao do seu carro com o comando ./definirPosicoes\033[00;37m" . PHP_EOL;
    }

    public static function successMessageSetPosition()
    {
        echo "\e[00;32mAs posicoes foram definidas com Sucesso!\e[00;37m" . PHP_EOL;
    }

    public static function successMessageStartRace()
    {
        echo "\e[00;32mCorrida Iniciada!\e[00;37m" . PHP_EOL;
    }

    public static function successMessageOvertaking($win, $lost)
    {
        echo "\e[00;32m" . $win . " ultrapassou " . $lost['Piloto'] . "!\e[00;37m" . PHP_EOL;
    }

    public static function showCars($car)
    {
        echo "-----------------------------" . PHP_EOL
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

    public static function podium($cars)
    {
        $p = 1;
        echo "Corrida Finalizada!" . PHP_EOL . PHP_EOL;
        echo "Ganhadores:" . PHP_EOL;
        for ($i = 0; $i < 3; $i++) {
            echo $p . "- " . $cars[$i]['Piloto'] . PHP_EOL;
            $p++;
        }
    }

    public static function report($item)
    {
        echo $item;
    }
}
