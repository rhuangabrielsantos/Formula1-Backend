<?php

namespace Commands;

use Controllers\CarController;
use Exception;
use Helper\Status;
use Helper\Validation;
use Lib\Storage;
use Views\View;

class DeleteCar implements TerminalCommand
{
    public static function runCommand(array $input): array
    {
        $pilotName = $input[CarController::PARAM_PILOT];

        try {
            $storage = new Storage();
            $dataCars = $storage->getDataCars();

            $validation = new Validation();
            $validation->raceInProgress($storage->getStatusRace());
            $validation->pilotIsNull($pilotName);
            $validation->pilotNameIsValid($pilotName, $dataCars);

            $returnedCars = (new CarController())->deleteCar($pilotName, $dataCars);
            $storage->setDataCars($returnedCars);

            return [
                'status' => Status::OK,
                'message' => View::successMessageDeleteCar()
            ];
        } catch (Exception $exception) {
            return [
                'status' => Status::ERROR,
                'message' => $exception->getMessage()
            ];
        }
    }
}