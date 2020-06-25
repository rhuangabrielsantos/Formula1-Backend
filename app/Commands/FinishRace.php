<?php

namespace Commands;

use Controllers\RaceController;
use Exception;
use Helper\Validation;
use Lib\Storage;
use Models\Race;
use Views\View;

class FinishRace implements TerminalCommand
{
    public function runCommand()
    {
        try {
            $storage = new Storage();

            (new Validation())->raceNotStarted($storage->getStatusRace());
            $returnedStatusRace = (new RaceController())->finishRace();

            (new Race())->setStatusRace($returnedStatusRace);

            (new View())->podium($storage->getDataCars());
        } catch (Exception $exception) {
            $exception->getMessage();
        }
    }
}