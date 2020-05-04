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
use Helper\FormatEntry;
use Lib\JSON;
use Lib\StorageFactory;
use Views\View;

class ExecuteCommand
{
    private $registeredCommands;

    public function __construct()
    {
        $storage = new StorageFactory(new JSON());

        $dataCars = $storage->getData('dataCars');
        $statusRace = $storage->getData('dataRace')['Start'];
        $reports = $storage->getData('report');

        $this->registeredCommands = $this->getRegisteredCommands($dataCars, $statusRace, $storage, $reports);
    }

    private function getRegisteredCommands($dataCars, $statusRace, StorageFactory $storage, $reports): array
    {
        return [
            'adicionarCarro' => new NewCar($_SERVER['argv'], $dataCars, $statusRace, $storage),
            'excluirCarro' => new DeleteCar($_SERVER['argv'], $dataCars, $statusRace, $storage),
            'definirPosicoes' => new DefinePosition($dataCars, $statusRace, $storage),
            'exibirCarros' => new ShowCars($dataCars),
            'iniciarCorrida' => new StartRace($dataCars, $statusRace, $storage),
            'finalizarCorrida' => new FinishRace($dataCars, $statusRace, $storage),
            'ultrapassar' => new OvertakeCar($_SERVER['argv'], $dataCars, $statusRace, $reports, $storage),
            'relatorio' => new ShowReports($reports)
        ];
    }

    public function run()
    {
        foreach ($this->registeredCommands as $registeredCommand => $class) {
            $userCommand = (new FormatEntry())->returnCommand($_SERVER['argv']);

            if ($userCommand == $registeredCommand) {
                $class->runCommand();
                return;
            }
        }

        echo (new View())->errorMessageCommands();
    }
}