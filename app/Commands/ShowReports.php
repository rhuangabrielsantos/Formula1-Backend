<?php

namespace Commands;

use Controllers\RaceController;
use Exception;
use Helper\Validation;
use Lib\Storage;

class ShowReports implements TerminalCommand
{
    public function runCommand()
    {
        try {
            $reports = (new Storage())->getReports();

            (new Validation())->existsReports($reports);

            (new RaceController())->showReports($reports);
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}