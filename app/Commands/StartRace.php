<?php

namespace Commands;

use Controllers\RaceController;
use Exception;
use Helper\Validation;
use Lib\Storage;
use Models\Race;
use Views\View;

class StartRace implements TerminalCommand
{
    public function runCommand()
    {
        try {
            $storage = new Storage();
            $dataCars = $storage->getDataCars();

            $validation = new Validation();
            $validation->raceAlreadyStarted($storage->getStatusRace());
            $validation->carsExists($dataCars);
            $validation->existsMoreOneCar($dataCars);
            $validation->positionsAreSet($dataCars);

            $returnedStatusRace = (new RaceController())->startRace();

            $race = new Race();
            $race->cleanReports();
            $race->setStatusRace($returnedStatusRace);

            (new View())->successMessageStartRace();
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}