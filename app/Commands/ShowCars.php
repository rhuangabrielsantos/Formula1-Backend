<?php

namespace Commands;

use Controllers\CarController;
use Exception;
use Helper\Validation;

class ShowCars implements Command
{
    private $dataCars;

    public function __construct(array $dataCars)
    {
        $this->dataCars = $dataCars;
    }

    public function runCommand()
    {
        try {
            $validation = new Validation();
            $validation->carsExists($this->dataCars);

            (new CarController())->showCars($this->dataCars);
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }

    }
}
