<?php

namespace Commands;

use Controllers\CarController;
use Exception;
use Helper\Validation;
use Lib\Storage;
use Views\View;

class DefinePosition implements TerminalCommand
{
    public function runCommand()
    {
        try {
            $storage = new Storage();
            $dataCars = $storage->getDataCars();

            $validation = new Validation();
            $validation->raceInProgress($storage->getStatusRace());
            $validation->carsExists($dataCars);

            $returnedCars = (new CarController())->setPosition($dataCars);
            $storage->setDataCars($returnedCars);

            (new View())->successMessageSetPosition();
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}