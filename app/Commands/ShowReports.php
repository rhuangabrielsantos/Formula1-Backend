<?php

namespace Commands;

use Controllers\RaceController;
use Exception;
use Helper\Status;
use Helper\Validation;
use Lib\Storage;

class ShowReports implements TerminalCommand
{
    public static function runCommand(array $arguments): array
    {
        try {
            $reports = (new Storage())->getReports();

            (new Validation())->existsReports($reports);

            return [
                'status' => Status::OK,
                'message' => (new RaceController())->showReports($reports)
            ];
        } catch (Exception $exception) {
            return [
                'status' => Status::ERROR,
                'message' => $exception->getMessage()
            ];
        }
    }
}