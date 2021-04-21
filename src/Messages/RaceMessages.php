<?php

namespace Api\Messages;

final class RaceMessages
{
    public static function errorMessage_CannotCreateOrDeleteCarsRaceInProgress(): string
    {
        return "A corrida está em andamento, para adicionar ou excluir novos carros a corrida precisa ser encerrada";
    }

    public static function errorMessage_ImpossibleToStartTheRaceWithJustOneCar(): string
    {
        return "Impossível começar corrida com apenas um carro";
    }

    public static function errorMessage_ImpossibleToStartTheRaceWithPositionNotDefined(): string
    {
        return "Para iniciar a corrida, os carros precisam de posições definidas";
    }

    public static function errorMessage_RaceInProgress(): string
    {
        return "A corrida já está em andamento!";
    }

    public static function errorMessage_NeedStartRace(): string
    {
        return "Voce precisa iniciar a corrida!" . PHP_EOL .
            "Para iniciar uma corrida use o comando 'php executarComando iniciarCorrida'";
    }

    public static function errorMessage_OvertakingFirsPlace(string $pilot): string
    {
        return "" . $pilot . " esta em primeiro lugar";
    }

    public static function successMessage_RaceStarted(): string
    {
        return "Corrida Iniciada!";
    }

    public static function successMessage_Overtaking(string $win, string $lost): string
    {
        return $win . " ultrapassou " . $lost . "!";
    }

    public static function podium(array $cars): string
    {
        $position = 1;

        $colors = [
            0 => "\e[00;33m",
            1 => "\e[00;37m",
            2 => "\e[00;36m"
        ];

        $podium = "Corrida Finalizada!" . PHP_EOL . PHP_EOL;
        $podium .= "Ganhadores:" . PHP_EOL;
        for ($i = 0; $i < 3; $i++) {
            if (!empty($cars[$i])) {
                $podium .= $colors[$i] . $position . "- " . $cars[$i]->getRacingDriver() . "" . PHP_EOL;
                $position++;
            }
        }

        return $podium;
    }
}
