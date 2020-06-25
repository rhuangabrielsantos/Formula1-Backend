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
    public function getRegisteredCommands($arguments): array
    {
        return [
            'adicionarCarro' => new NewCar($arguments),
            'excluirCarro' => new DeleteCar($arguments),
            'definirPosicoes' => new DefinePosition(),
            'exibirCarros' => new ShowCars(),
            'iniciarCorrida' => new StartRace(),
            'finalizarCorrida' => new FinishRace(),
            'ultrapassar' => new OvertakeCar($arguments),
            'relatorio' => new ShowReports()
        ];
    }
}
