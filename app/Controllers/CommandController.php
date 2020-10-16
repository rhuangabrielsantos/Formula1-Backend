<?php

namespace Controllers;

use Commands\DefinePosition;
use Commands\DeleteCar;
use Commands\FinishRace;
use Commands\NewCar;
use Commands\OvertakeCar;
use Commands\ShowCars;
use Commands\ShowReports;
use Commands\StartRace;

class CommandController
{
    public function getRegisteredCommands(): array
    {
        return [
            'adicionarCarro' => NewCar::class,
            'excluirCarro' => DeleteCar::class,
            'definirPosicoes' => DefinePosition::class,
            'exibirCarros' => ShowCars::class,
            'iniciarCorrida' => StartRace::class,
            'finalizarCorrida' => FinishRace::class,
            'ultrapassar' => OvertakeCar::class,
            'relatorio' => ShowReports::class
        ];
    }
}
