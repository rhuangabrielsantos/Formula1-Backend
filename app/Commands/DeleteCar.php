<?php

namespace Commands;

use Controllers\CarController;
use Exception;
use Helper\FormatEntry;
use Helper\Validation;
use Lib\StorageFactory;
use Models\Car;
use Views\View;

class DeleteCar implements Command
{
    private $dataCars;
    private $statusRace;
    private $input;
    private $storage;

    public function __construct(array $input, array $dataCars, string $statusRace, StorageFactory $storage)
    {
        $this->input = $input;
        $this->dataCars = $dataCars;
        $this->statusRace = $statusRace;
        $this->storage = $storage;
    }

    public function runCommand()
    {
        try {
            $pilotName = (new FormatEntry())->returnPilotName($this->input);

            $validation = new Validation();
            $validation->raceInProgress($this->statusRace);
            $validation->pilotIsNull($pilotName);

            $returnedCars = (new CarController())->deleteCar($pilotName, $this->dataCars);

            (new Car())->setCars($this->storage, $returnedCars);
            (new View())->successMessageDeleteCar();
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}