<?php

namespace Commands;

use Controllers\CarController;
use Exception;
use Helper\Validation;
use Lib\StorageFactory;
use Models\Car;
use Views\View;

class DefinePosition implements Command
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
            $validation->raceInProgress($this->statusRace);
            $validation->carsExists($this->dataCars);

            $returnedCars = (new CarController())->setPosition($this->dataCars);

            (new Car())->setCars($this->storage, $returnedCars);
            (new View())->successMessageSetPosition();
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}