<?php

namespace Commands;

use Controllers\RaceController;
use Controllers\ReportController;
use Exception;
use Helper\Status;
use Helper\Validation;
use Lib\Storage;
use Views\View;

class StartRace implements TerminalCommand
{
    public static function runCommand(array $arguments): array
    {
        try {
            $storage = new Storage();
            $dataCars = $storage->getDataCars();

            $validation = new Validation();
            $validation->raceAlreadyStarted($storage->getStatusRace());
            $validation->carsExists($dataCars);
            $validation->existsMoreOneCar($dataCars);
            $validation->positionsAreSet($dataCars);

            (new RaceController())->startRace();
            (new ReportController())->cleanReports();

            return [
                'status' => Status::OK,
                'message' => (new View())->successMessageStartRace()
            ];
        } catch (Exception $exception) {
            return [
                'status' => Status::ERROR,
                'message' => $exception->getMessage()
            ];
        }
    }
}