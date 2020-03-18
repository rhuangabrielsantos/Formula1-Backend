<?php

namespace Commands;

use Controllers\CarController;

class ShowCars implements Command
{
    private $dataCars;

    public function __construct(array $dataCars)
    {
        $this->dataCars = $dataCars;
    }

    public function runCommand()
    {
        (new CarController())->showCars($this->dataCars);
    }
}