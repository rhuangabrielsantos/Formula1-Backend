<?php

namespace Commands;

use Controllers\CarController;
use Exception;
use Helper\Status;
use Helper\Validation;
use Lib\Storage;
use Views\View;

class DefinePosition implements TerminalCommand
{
    public static function runCommand(array $arguments): array
    {
        try {
            $storage = new Storage();
            $dataCars = $storage->getDataCars();

            $validation = new Validation();
            $validation->raceInProgress($storage->getStatusRace());
            $validation->carsExists($dataCars);

            $returnedCars = (new CarController())->setPosition($dataCars);
            $storage->setDataCars($returnedCars);

            return [
                'status' => Status::OK,
                'message' => (new View())->successMessageSetPosition()
            ];
        } catch (Exception $exception) {
            return [
                'status' => Status::ERROR,
                'message' => $exception->getMessage()
            ];
        }
    }
}