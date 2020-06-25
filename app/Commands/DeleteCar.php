<?php

namespace Commands;

use Controllers\CarController;
use Exception;
use Helper\Validation;
use Lib\Storage;
use Views\View;

class DeleteCar implements TerminalCommand
{
    private $pilotName;

    public function __construct(array $input)
    {
        $this->pilotName = $input[CarController::PARAM_PILOT];
    }

    public function runCommand()
    {
        try {
            $storage = new Storage();

            $validation = new Validation();
            $validation->raceInProgress($storage->getStatusRace());
            $validation->pilotIsNull($this->pilotName);

            $returnedCars = (new CarController())->deleteCar($this->pilotName, $storage->getDataCars());
            $storage->setDataCars($returnedCars);

            (new View())->successMessageDeleteCar();
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}