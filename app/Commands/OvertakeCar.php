<?php

namespace Commands;

use Controllers\CarController;
use Controllers\RaceController;
use Exception;
use Helper\Status;
use Helper\Validation;
use Lib\Storage;
use Views\View;

class OvertakeCar implements TerminalCommand
{
    const CARS = 0;
    const REPORT = 1;
    const LOST_PILOT = 2;

    public static function runCommand(array $input): array
    {
        $pilotName = $input[CarController::PARAM_PILOT];

        try {
            $storage = new Storage();
            $dataCars = $storage->getDataCars();

            $validation = new Validation();
            $validation->pilotIsNullOvertake($pilotName);
            $validation->raceNotStarted($storage->getStatusRace());
            $validation->pilotNameIsValid($pilotName, $dataCars);
            $validation->carIsTheFirst($storage->getDataCarsByPilotName($pilotName));

            $returnedValues = (new RaceController())->overtake(
                $pilotName,
                $dataCars,
                $storage->getReports()
            );

            $storage->setDataCars($returnedValues[self::CARS]);
            $storage->setReports($returnedValues[self::REPORT]);

            return [
                'status' => Status::OK,
                'message' => View::successMessageOvertaking($pilotName, $returnedValues[self::LOST_PILOT])
            ];
        } catch (Exception $exception) {
            return [
                'status' => Status::ERROR,
                'message' => $exception->getMessage()
            ];
        }
    }
}
