<?php

namespace Commands;

use Controllers\RaceController;
use Exception;
use Helper\Status;
use Helper\Validation;
use Lib\Storage;

class FinishRace implements TerminalCommand
{
    public static function runCommand(array $arguments): array
    {
        try {
            $storage = new Storage();

            (new Validation())->raceNotStarted($storage->getStatusRace());

            $raceControllerInstance = new RaceController();
            $raceControllerInstance->finishRace();

            return [
                'status' => Status::OK,
                'message' => $raceControllerInstance->showPodium()
            ];
        } catch (Exception $exception) {
            return [
                'status' => Status::ERROR,
                'message' => $exception->getMessage()
            ];
        }
    }
}