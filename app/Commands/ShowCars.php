<?php

namespace Commands;

use Controllers\CarController;
use Exception;
use Helper\Status;
use Helper\Validation;
use Lib\Storage;

class ShowCars implements TerminalCommand
{
    public static function runCommand(array $arguments): array
    {
        try {
            $dataCars = (new Storage())->getDataCars();

            (new Validation())->carsExists($dataCars);

            return [
                'status' => Status::OK,
                'message' => (new CarController())->showCars($dataCars)
            ];
        } catch (Exception $exception) {
            return [
                'status' => Status::ERROR,
                'message' => $exception->getMessage()
            ];
        }

    }
}
