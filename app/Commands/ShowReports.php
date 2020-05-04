<?php

namespace Commands;

use Controllers\RaceController;
use Exception;
use Helper\Validation;

class ShowReports implements Command
{
    private $reports;

    public function __construct(array $reports)
    {
        $this->reports = $reports;
    }

    public function runCommand()
    {
        try {
            (new Validation())->existsReports($this->reports);
            (new RaceController())->getReport($this->reports);
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}