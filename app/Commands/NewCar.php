<?php

namespace Commands;

use Controllers\CarController;
use Exception;
use Helper\Status;
use Helper\Validation;
use Lib\Storage;
use Views\View;

class NewCar implements TerminalCommand
{
    public static function runCommand(array $inputCars): array
    {
        try {
            $storage = new Storage();
            $dataCars = $storage->getDataCars();

            $validation = new Validation();
            $validation->paramsAreValid($inputCars);
            $validation->raceInProgress($storage->getStatusRace());
            $validation->yearIsValid($inputCars[CarController::PARAM_YEAR]);
            $validation->pilotExists($inputCars[CarController::PARAM_PILOT], $dataCars);

            $returnedCars = (new CarController())->newCar($inputCars, $dataCars);
            $storage->setDataCars($returnedCars);

            return [
                'status' => Status::CREATED,
                'message' => View::successMessageNewCar()
            ];
        } catch (Exception $exception) {
            return [
                'status' => Status::ERROR,
                'message' => $exception->getMessage()
            ];
        }
    }
}