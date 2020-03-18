<?php

namespace Commands;

use Controllers\RaceController;
use Lib\StorageFactory;
use Models\Race;
use Views\View;

class StartRace implements Command
{
    private $dataCars;
    private $statusRace;
    private $storage;

    public function __construct(array $dataCars, string $statusRace, StorageFactory $storage)
    {
        $this->dataCars = $dataCars;
        $this->statusRace = $statusRace;
        $this->storage = $storage;
    }

    public function runCommand()
    {
        $returnedStatusRace = (new RaceController())->startRace(
            $this->statusRace,
            $this->dataCars
        );

        $race = new Race();
        $race->setReports($this->storage, []);
        $race->setStatusRace($this->storage, $returnedStatusRace);

        (new View())->successMessageStartRace();
    }
}