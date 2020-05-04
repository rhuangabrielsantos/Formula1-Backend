<?php

namespace Commands;

use Controllers\RaceController;
use Exception;
use Helper\Validation;
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
        try {
            $validation = new Validation();
            $validation->raceAlreadyStarted($this->statusRace);
            $validation->carsExists($this->dataCars);
            $validation->existsMoreOneCar($this->dataCars);
            $validation->positionsAreSet($this->dataCars);

            $returnedStatusRace = (new RaceController())->startRace();

            $race = new Race();
            $race->setReports($this->storage, []);
            $race->setStatusRace($this->storage, $returnedStatusRace);

            (new View())->successMessageStartRace();
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}