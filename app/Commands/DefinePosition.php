<?php

namespace Commands;

use Controllers\CarController;
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
        $returnedCars = (new CarController())->setPosition(
            $this->dataCars,
            $this->statusRace
        );

        (new Car())->setCars($this->storage, $returnedCars);
        (new View())->successMessageNewCar();
    }
}