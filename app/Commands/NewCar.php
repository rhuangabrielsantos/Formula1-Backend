<?php

namespace Commands;

use Controllers\CarController;
use Exception;
use Helper\Validation;
use Lib\Storage;
use Views\View;

class NewCar implements TerminalCommand
{
    private $inputCars;

    public function __construct(array $inputCars)
    {
        $this->inputCars = $inputCars;
    }

    public function runCommand()
    {
        try {
            $storage = new Storage();
            $dataCars = $storage->getDataCars();

            $validation = new Validation();
            $validation->paramsAreValid($this->inputCars);
            $validation->raceInProgress($storage->getStatusRace());
            $validation->yearIsValid($this->inputCars[CarController::PARAM_YEAR]);
            $validation->pilotExists($this->inputCars[CarController::PARAM_PILOT], $dataCars);

            $returnedCars = (new CarController())->newCar($this->inputCars, $dataCars);
            $storage->setDataCars($returnedCars);

            (new View())->successMessageNewCar();
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}