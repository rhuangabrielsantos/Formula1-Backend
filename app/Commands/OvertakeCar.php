<?php

namespace Commands;

use Controllers\RaceController;
use Exception;
use Helper\FormatEntry;
use Helper\Validation;
use Lib\StorageFactory;
use Models\Race;

class OvertakeCar implements Command
{
    const CARS = 0;
    const REPORT = 1;

    private $dataCars;
    private $statusRace;
    private $storage;
    private $input;
    private $reports;

    public function __construct(array $input, array $dataCars, string $statusRace, array $reports, StorageFactory $storage)
    {
        $this->input = $input;
        $this->dataCars = $dataCars;
        $this->statusRace = $statusRace;
        $this->reports = $reports;
        $this->storage = $storage;
    }

    public function runCommand()
    {
        try {
            $pilotName = (new FormatEntry())->returnPilotNameForOvertakeCars($this->input);

            $validation = new Validation();
            $validation->raceNotStarted($this->statusRace);

            $returnedValues = (new RaceController())->overtake($pilotName, $this->dataCars, $this->reports);

            (new Race())->overtake($this->storage, $returnedValues[self::CARS]);
            (new Race())->setReports($this->storage, $returnedValues[self::REPORT]);
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
