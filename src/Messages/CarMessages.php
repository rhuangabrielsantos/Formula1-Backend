<?php

namespace Api\Messages;

use Api\Entities\Car;

final class CarMessages
{
    public static function errorMessage_InvalidArgumentsToCreateANewCar(): string
    {
        return "Adicione todas as informações para adicionar um carro";
    }

    public static function errorMessage_ThereAreNoCars(): string
    {
        return "Não existem carros.";
    }

    public static function errorMessage_YearNotInteger(): string
    {
        return "É necessário que o ano seja um numero positivo e inteiro";
    }

    public static function successMessage_CreatedCar(): string
    {
        return "Carro Salvo com Sucesso!" . PHP_EOL
            . "Lembre-se de definir a posicao do seu carro com o comando 'php executarComando definirPosicoes'";
    }

    public static function successMessage_DefinedPosition(): string
    {
        return "As posicoes foram definidas com Sucesso!";
    }

    public static function successMessage_DeletedCar(): string
    {
        return "Carro deletado com sucesso!";
    }


    public static function showCar(array $car): string
    {
        $carInfo = "-----------------------------" . PHP_EOL
            . "Piloto - " . $car['racing_driver'] . PHP_EOL
            . "Marca - " . $car['brand'] . PHP_EOL
            . "Modelo - " . $car['model'] . PHP_EOL
            . "Cor - " . $car['color'] . PHP_EOL
            . "Ano - " . $car['year'] . PHP_EOL;

        if (!empty($car['position'])) {
            $carInfo .= "Posicao - " . $car['position'] . PHP_EOL;
        }

        return $carInfo;
    }
}
