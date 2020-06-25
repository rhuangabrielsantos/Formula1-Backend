<?php

namespace Commands;

use Controllers\CarController;
use Exception;
use Helper\Validation;
use Lib\Storage;

class ShowCars implements TerminalCommand
{
    public function runCommand()
    {
        try {
            $dataCars = (new Storage())->getData('dataCars');

            (new Validation())->carsExists($dataCars);

            (new CarController())->showCars($dataCars);
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }

    }
}
