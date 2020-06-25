<?php

namespace Commands;

use Controllers\CarController;
use Controllers\RaceController;
use Exception;
use Helper\Validation;
use Lib\Storage;

class OvertakeCar implements TerminalCommand
{
    const CARS = 0;
    const REPORT = 1;

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
            $validation->raceNotStarted($storage->getStatusRace());
            $validation->pilotIsNullOvertake($this->pilotName);

            $returnedValues = (new RaceController())->overtake(
                $this->pilotName,
                $storage->getDataCars(),
                $storage->getReports()
            );

            $storage->setDataCars($returnedValues[self::CARS]);
            $storage->setReports($returnedValues[self::REPORT]);
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
