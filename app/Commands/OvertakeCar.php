<?php

namespace Commands;

use Controllers\RaceController;
use Helper\FormatEntry;
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
        $returnedValues = (new RaceController())->overtake(
            (new FormatEntry())->returnOvertakeCars($this->input),
            $this->statusRace,
            $this->dataCars,
            $this->reports
        );

        (new Race())->overtake($this->storage, $returnedValues[self::CARS]);
        (new Race())->setReports($this->storage, $returnedValues[self::REPORT]);
    }
}