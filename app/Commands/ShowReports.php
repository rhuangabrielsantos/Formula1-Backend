<?php

namespace Commands;

use Controllers\RaceController;

class ShowReports implements Command
{
    private $reports;

    public function __construct(array $reports)
    {
        $this->reports = $reports;
    }

    public function runCommand()
    {
        (new RaceController())->getReport($this->reports);
    }
}