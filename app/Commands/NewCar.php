<?php

namespace Commands;

use Controllers\CarController;
use Exception;
use Helper\FormatEntry;
use Helper\Validation;
use Lib\StorageFactory;
use Models\Car;
use Views\View;

class NewCar implements Command
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
            $validation = new Validation();
            $validation->paramsAreValid($this->input);

            $inputCarFormatted = (new FormatEntry)->returnNewCars($this->input);

            $validation->raceInProgress($this->statusRace);
            $validation->pilotExists($inputCarFormatted[CarController::PARAM_PILOT], $this->dataCars);

            $returnedCars = (new CarController())->newCar($inputCarFormatted, $this->dataCars);

            (new Car())->setCars($this->storage, $returnedCars);
            (new View())->successMessageNewCar();
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}